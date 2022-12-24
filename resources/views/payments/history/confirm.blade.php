<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">ត្រឡប់ប្រតិបត្តិការ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                តើលោកអ្នកពិតជាចង់ត្រលប់ប្រតិបត្តិការនេះពិតមែនទេ?
            </div>
            <div class="modal-footer">
                <form method="post">
                    @csrf
                    <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">អត់ទេ</button>
                    <button type="submit" class="btn btn-primary">ត្រឡប់</button>
                </form>
            </div>
        </div>
    </div>
</div>