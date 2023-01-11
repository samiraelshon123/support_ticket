<script src="{{asset('assets/dist/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/js/style.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

{{-- tags input --}}
<script src="{{asset('assets/js/bootstrap-tagsinput.js')}}"></script>
{{-- delete modal --}}

<script>
    $(document).on("click", ".open-deleteDialog", function () {

        document.getElementById('deleteFormAction').action = $(this).attr('data-action');
    });
</script>
