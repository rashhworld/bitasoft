<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="footer-widget" id="about">
          <h5 class="title">About</h5>
          <p>
          Welcome to bitasoft, where learning is made fun and engaging! This platform provides a comprehensive and interactive learning experience, designed for fellows who keep a keen interest in technology and stuff. You'll be provided with a wealth of resources, including lessons, notes, quizzes, and more. Whether you're a student looking to improve your grades, a parent seeking educational resources for your child, or a teacher searching for new teaching strategies, it is the perfect place to start. explore now on this exciting journey of learning and discovery!</p>
          <p>For more info, Email : <a href=""><b>admin@bitasoft.in</b></a></p>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="footer-widget" id="contact">
          <h5 class="title">Contact</h5>
          <p>Feel free to share your feedback, query, suggestions</p>
          <form action="" class="row">
            <div class="form-group col-sm-6">
              <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter your Name">
            </div>
            <div class="form-group col-sm-6">
              <input type="text" class="form-control" name="userEmail" id="userEmail" placeholder="Enter your Email">
            </div>
            <div class="form-group col-sm-12">
              <textarea name="userMessage" class="form-control" id="userMessage" placeholder="Enter your Message"></textarea>
            </div>
            <div class="col-12 text-center mt-4">
              <button type="submit" class="btn btn-primary w-100">Submit your Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <hr>
    <div class="row copyright">
      <div class="col-12 text-center">
        <p>Copyright © 2022-<?= date("Y") ?> by <a href="<?= base_url('admin') ?>">Bitasoft.in</a>. All rights reserved.</p>
        <p>
          <span>Template by <a target="_blank" class="text-warning" href="https://www.wowthemes.net/">WowThemes</a></span> |
          <span>Developed by <a target="_blank" class="text-warning" href="https://rashhworld.github.io/">RashhWorld</a></span>
        </p>
        
        <a href="http://www.cutercounter.com/" target="_blank"><img src="https://www.cutercounter.com/hits.php?id=hexndxpx&nd=5&style=80" border="0" alt="best free website hit counter"></a>
      </div>
    </div>
  </div>
</footer>
</div>

<div class="back-to-top"><span></span></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zooming/2.1.1/zooming.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?theme=flying&always=1"></script>
<script src="<?= base_url('assets/lander/js/ie10-viewport-bug-workaround.js?v=') . time() ?>"></script>
<script src="<?= base_url('assets/lander/js/masonry.pkgd.min.js?v=') . time() ?>"></script>
<script src="<?= base_url('assets/lander/js/prism.js?v=') . time() ?>"></script>
<script src="<?= base_url('assets/lander/js/theme.js?v=') . time() ?>"></script>
<script>
  var baseURL = "<?= base_url(); ?>";
</script>
</body>

</html>