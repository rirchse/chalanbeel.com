<?php
namespace App\Services;

use SNMP;
use Exception;

class VsolSnmpService
{
    protected string $host;
    protected string $community;

    public function __construct()
    {
        $this->host = config('services.vsol_olt.host');
        $this->community = config('services.vsol_olt.community', 'public');
    }

    public function getAllOnus(): array
    {
        $snmp = new SNMP(SNMP::VERSION_2C, $this->host, $this->community);

        // 1. Force numeric OIDs in keys (e.g., .1.3.6.1.4.1.37950...)
        $snmp->oid_output_format = SNMP_OID_OUTPUT_NUMERIC;

        // 2. Return clean values without types (e.g., "1" instead of "INTEGER: 1")
        $snmp->valueretrieval = SNMP_VALUE_PLAIN;
        $snmp->quick_print = 1;

        // OIDs for VSOL V1600
        $macOid    = '.1.3.6.1.4.1.37950.1.1.5.12.1.25.1.5'; // ONU Serial/MAC
        $statusOid = '.1.3.6.1.4.1.37950.1.1.5.12.1.25.1.4'; // ONU Status

        try {
            $rawMacs     = $snmp->walk($macOid);
            $rawStatuses = $snmp->walk($statusOid);

            $onus = [];

            if ($rawMacs && is_array($rawMacs)) {
                foreach ($rawMacs as $fullOid => $macValue) {
                    // Extract index tail (e.g., "1.1", "1.2")
                    $index = str_replace($macOid . '.', '', $fullOid);

                    // Construct key for status lookup
                    $targetStatusOid = $statusOid . '.' . $index;
                    $rawStatus = $rawStatuses[$targetStatusOid] ?? null;

                    // Clean status value
                    $statusCode = $rawStatus !== null ? (int) trim($rawStatus, ' "') : null;

                    $onus[] = [
                        'index'       => $index,
                        'mac_address' => trim($macValue, ' "'),
                        // 'status_code' => $statusCode,
                        'status'      => $statusCode === 1 ? 'online' : 'offline',
                    ];
                }
            }

            $snmp->close();
            return $onus;

        } catch (Exception $e) {
            $snmp->close();
            throw new Exception("SNMP Walk Error: " . $e->getMessage());
        }
    }
}