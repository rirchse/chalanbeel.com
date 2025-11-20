@extends('admin')
@section('title', 'Edit Package')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Edit Package</h4>
                    </div>
                    <div class="toolbar">
                        <a class="btn-simple btn-icon text-info" href="/admin/package/{{$package->id}}" title="Details"><i class="material-icons">dvr</i></a>
                        <a class="btn-simple btn-icon text-success" href="/admin/package" title="View"><i class="material-icons">subject</i></a>
                    </div>
                    
                    <form action="{{route('package.update', $package->id)}}" method="POST" id="RegisterValidation">
                      @csrf
                      @method('PUT')

                    <div class="row">
                      <div class=" col-md-12">
                          <div class="form-group label-floating">
                              <label for="">Speed(*):</label>
                              <input type="text" class="form-control" name="speed" required value="{{$package->speed}}">
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Time Limit in Days(*):</label>
                              <input type="number" class="form-control" name="time_limit" required value="{{$package->time_limit}}">
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Price(*):</label>
                              <input type="number" class="form-control" name="price" required step="0.1" value="{{$package->price}}">
                          </div>
                          <div class="form-group label-floating">
                              <label>Status:</label>
                              <br>
                              <input type="radio" name="status" value="Active" {{$package->status == 'Active'? 'checked': ''}}> Active &nbsp; 
                              <input type="radio" name="status" value="Inactive" {{$package->status == 'Inactive'? 'checked': ''}}> Inactive
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Package Features (List Items):</label>
                              <div id="list-items-container">
                                  @php
                                      $listItems = [];
                                      if (!empty($package->details)) {
                                          $decoded = json_decode($package->details, true);
                                          if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                              $listItems = $decoded;
                                          } else {
                                              // If it's not JSON, treat as single item
                                              $listItems = [$package->details];
                                          }
                                      }
                                      if (empty($listItems)) {
                                          $listItems = [''];
                                      }
                                  @endphp
                                  @foreach($listItems as $item)
                                  <div class="list-item-row" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center;">
                                      <input type="text" class="form-control list-item-input" name="list_items[]" value="{{ $item }}" placeholder="Enter feature/item">
                                      <button type="button" class="btn btn-danger btn-sm remove-item-btn" onclick="removeListItem(this)" style="display: none;">
                                          <i class="material-icons">delete</i>
                                      </button>
                                  </div>
                                  @endforeach
                              </div>
                              <button type="button" class="btn btn-success btn-sm" onclick="addListItem()" style="margin-top: 10px;">
                                  <i class="material-icons">add</i> Add Item
                              </button>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">save</i> Save</button>
                      </div>
                  </div>

                    
                </form>
                    
                </div>
            </div>
        </div>
    </div>

<script>
function addListItem() {
    const container = document.getElementById('list-items-container');
    const newRow = document.createElement('div');
    newRow.className = 'list-item-row';
    newRow.style.cssText = 'display: flex; gap: 10px; margin-bottom: 10px; align-items: center;';
    newRow.innerHTML = `
        <input type="text" class="form-control list-item-input" name="list_items[]" placeholder="Enter feature/item">
        <button type="button" class="btn btn-danger btn-sm remove-item-btn" onclick="removeListItem(this)">
            <i class="material-icons">delete</i>
        </button>
    `;
    container.appendChild(newRow);
    updateRemoveButtons();
}

function removeListItem(btn) {
    btn.closest('.list-item-row').remove();
    updateRemoveButtons();
}

function updateRemoveButtons() {
    const rows = document.querySelectorAll('.list-item-row');
    rows.forEach((row, index) => {
        const removeBtn = row.querySelector('.remove-item-btn');
        if (rows.length > 1) {
            removeBtn.style.display = 'block';
        } else {
            removeBtn.style.display = 'none';
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateRemoveButtons();
});
</script>

@endsection