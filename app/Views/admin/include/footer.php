</div>

<div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 9999">
  <div class="toast align-items-center text-white border-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<div class="position-absolute top-50 start-50 translate-middle d-none loader">
  <div class="spinner-grow text-success" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <div class="spinner-grow text-danger" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <div class="spinner-grow text-warning" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<script src="https://cdn.tiny.cloud/1/f80l7noolnav49bcucrzskvhythaacten8n27dlmqv5nqdkz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?theme=flying&always=1"></script>
<script src="<?= base_url('assets/lander/js/prism.js?v=') . time() ?>"></script>
<script src="<?= base_url('assets/plugin/js/main.js?v=') . time() ?>"></script>
<script type="text/javascript">
  var baseURL = "<?= base_url(); ?>";
  var toast = new bootstrap.Toast($('.toast'));
</script>
</body>

</html>