</div>
</div>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{$config->title}} {{date('Y')}}</span>
        </div>
    </div>
</footer>

</div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Çıkış yapmak istediginize emin misiniz ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Mevcut oturumunuzu bitirmeye hazırsanız, aşağıdan "Çıkış"ı seçin.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                <a class="btn btn-primary" href="{{route('admin.logout')}}">Çıkış</a>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('back/')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('back/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@yield('extra-js')

<script src="{{asset('back/')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="{{asset('back/')}}/js/sb-admin-2.min.js"></script>
@toastr_js
@toastr_render


</body>

</html>
