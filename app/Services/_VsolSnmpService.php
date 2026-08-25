<?php
namespace App\Services;

use SNMP;
use Exception;

class VsolSnmpService
{
    protected $host;
    protected $community;

    public function __construct()
    {
        $this->host = config('services.vsol_olt.host');
        $this->community = config('services.vsol_olt.community', 'public');
    }

    /**
     * Get all registered ONUs with MAC address and Online status
     */
    public function getAllOnus(): array
    {
        $snmp = new SNMP(SNMP::VERSION_2C, $this->host, $this->community);
        
        // Strip data type tags (e.g., returns raw values instead of "STRING: ...")
        $snmp->valueretrieval = SNMP_VALUE_PLAIN;
        $snmp->quick_print = 1;

        // Base OID for ONU MAC Addresses / Serial Numbers on VSOL V1600
        $macOid = '.1.3.6.1.4.1.37950.1.1.5.12.1.25.1.5';
        
        // Base OID for ONU Status (1 = Online, 2 = Offline)
        $statusOid = '.1.3.6.1.4.1.37950.1.1.5.12.1.25.1.4';

        try {
            // Perform SNMP Walk across the ONU tables
            $rawMacs = $snmp->walk($macOid);
            $rawStatuses = $snmp->walk($statusOid);

            $onus = [];

            if ($rawMacs && is_array($rawMacs)) {
                foreach ($rawMacs as $indexOid => $macValue) {
                    // Extract index key from OID
                    $key = str_replace($macOid . '.', '', $indexOid);

                    // Map status corresponding to the same key index
                    $statusCode = $rawStatuses[$statusOid . '.' . $key] ?? null;

                    $onus[] = [
                        'index' => $key,
                        'mac_address' => trim($macValue, ' "'),
                        'status' => $statusCode == 1 ? 'online' : 'offline',
                        'status_code' => (int) $statusCode,
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