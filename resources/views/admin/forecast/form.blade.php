@extends('admin.layouts.template')
@section('page_title')
    CIME
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Forecasting</h4>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Input Data Forecasting</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('predict') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="bulan">Bulan (format: YYYY-MM)</label>
                            <input type="text" class="form-control" id="bulan" name="bulan[]" placeholder="2024-01" required>
                            <small class="text-muted">Masukkan minimal 12 bulan data</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="terjual">Jumlah Terjual</label>
                            <input type="number" class="form-control" id="terjual" name="terjual[]" required>
                        </div>
                        
                        <div id="additionalInputs"></div>                        
                        <button type="button" class="btn btn-secondary mb-3" onclick="addInput()">Tambah Data</button>
                        <button type="submit" class="btn btn-primary">Prediksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let inputCount = 1;

function addInput() {
    if (inputCount < 12) {
        const container = document.getElementById('additionalInputs');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-3';
        newRow.innerHTML = `
            <div class="col-md-6">
                <input type="text" class="form-control" name="bulan[]" placeholder="YYYY-MM" required>
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="terjual[]" required>
            </div>
        `;
        container.appendChild(newRow);
        inputCount++;
    }
}
</script>
@endsection 