<form id="gt--form">
    <div class="modal-body">
        @csrf
            <table id="gtable" class="table">
                <thead>
                <tr>
                    <th class="__kh__" style="border-top: none"># ឈ្មោះអ្នកធានា</th>
                    <th class="__kh__" style="border-top: none">ភេទ</th>
                    <th class="__kh__" style="border-top: none">លេខទូរស័ព្ទ</th>
                    <th class="__kh__" style="border-top: none">អាសយដ្ឋាន</th>
                    <th class="__kh__" style="border-top: none">ថ្ងៃខែឆ្នាំកំណើត</th>
                    <th class="__kh__" style="border-top: none">លេខអត្តសញ្ញាណប័ណ្ណ</th>
                </tr>
                </thead>
            </table>
        
    </div>

    <div class="modal-footer justify-content-between">
        <div>
            
        </div>
        <div>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i> បោះបង់
        </button>
        <button type="submit" class="btn btn-dark">
            <i class="fas fa-save mr-1"></i>
            យល់ព្រម
        </button>
        </div>
    </div>
</form>