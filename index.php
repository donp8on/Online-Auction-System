<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

	
    ?>

    <style>
      #main-field{
        margin-top: 5rem!important;
      }
    </style>

    <style>
      :root {
          --color-primary:rgb(171, 77, 0);
          --color-secondary:rgb(255, 219, 162);
          --color-neutral-lt: #fff;
          --color-neutral-med: #ddd;
          --color-neutral-dk: #444;
          --headings-font: 'Saira Semi Condensed', sans-serif;
          --shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
      }

      button, input[type="button"], input[type="submit"], button:focus, input:focus {
          background: none;
          border: none;
          box-shadow: none;
          cursor: pointer;
          outline: none;
      }

      html {
          scroll-behavior: smooth;
      }

      body {
          font-family: var(--headings-font);
          line-height: 1.5;
          margin: 0;
          padding: 0;
      }

      section {
          height: 100vh;
      }

      #home, #about, #work, #contact {
          background-color: var(--color-neutral-med);
      }

      .skew {
          transform: skew(-20deg);
      }

      .un-skew {
          transform: skew(20deg);
      }

      #nav-wrapper {
          margin: 0 auto;
          overflow: hidden;
          position: fixed;
          top: 0; left: 0;
          width: 100%;
          z-index: 100;
      }

      #nav {
          background-color: var(--color-neutral-lt);
          box-shadow: var(--shadow);
          display: flex;
          flex-direction: column;
          height: 4em;
          overflow: hidden;
      }

      #nav.nav-visible {
          height: 100%;
          overflow: auto;
      }

      .nav {
          display: flex;
          flex-grow: 1;
          height: 4em;
          line-height: 4em;
      }

      .nav-link, .logo {
          padding: 0 1em;
      }

      span.gradient {
          background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
          margin-right: auto;
          padding: 0 1em;
          position: relative;
          right: 1em;
      }

      .nav-link {
          border-top: 0.5px solid var(--color-neutral-med);
          color: var(--color-neutral-dk);
          text-align: center;
          text-transform: uppercase;
      }

      .nav-link:hover, a:hover {
          text-decoration: underline;
      }

      a:link, a:visited, a:active {
          color: var(--color-primary);
          text-decoration: none;
      }

      @media (min-width: 800px) {
          #nav {
              flex-direction: row;
          }

          .nav-link {
              border-top: none;
          }

          .right {
              display: flex;
              flex-direction: row;
              height: auto;
              justify-content: flex-end;
              left: 1.5em;
              position: relative;
          }

          .btn-nav {
              display: none;
          }

          a:link.active, a:visited.active, a:active.active {
              background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
              color: var(--color-neutral-lt);
          }
      }
    </style>

    <body id="page-top">
      <!--
        
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><?php echo "Welcome ".$_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a></li>
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
                      <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>-->

  <!--Nav-->
  <header id="nav-wrapper">
    <nav id="nav">
      <div class="nav left">
        <span class="gradient skew"><h1 class="logo un-skew"><a href="#home" class="text-white">VSU Auctions</a></h1></span>
        <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
      </div>
      <div class="nav right">
        <a href="#home" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Home</span></span></a>
        <a href="#about" class="nav-link"><span class="nav-link-span"><span class="u-nav">About</span></span></a>
        <a href="#work" class="nav-link"><span class="nav-link-span"><span class="u-nav">Work</span></span></a>
        <a href="#contact" class="nav-link"><span class="nav-link-span"><span class="u-nav">Contact</span></span></a>
      </div>
    </nav>
  </header>



  <main id="main-field">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>
       
</main>
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class=" py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0 text-primary">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="text-primary">+1(804)524-5210</div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <a class="d-block text-primary">vsuauctions@vsu.edu</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">Copyright © 2025 - Parallel & Distrubited SPR 25 Project | Albert & Adonis</div></div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })
      $('.datetimepicker').datetimepicker({
          format:'Y-m-d H:i',
      })
      $('#find-car').submit(function(e){
        e.preventDefault()
        location.href = 'index.php?page=search&'+$(this).serialize()
      })
    </script>

    <script>
          var util = {
      mobileMenu() {
        $("#nav").toggleClass("nav-visible");
      },
      windowResize() {
        if ($(window).width() > 800) {
          $("#nav").removeClass("nav-visible");
        }
      },
      scrollEvent() {
        var scrollPosition = $(document).scrollTop();
        
        $.each(util.scrollMenuIds, function(i) {
          var link = util.scrollMenuIds[i],
              container = $(link).attr("href"),
              containerOffset = $(container).offset().top,
              containerHeight = $(container).outerHeight(),
              containerBottom = containerOffset + containerHeight;

          if (scrollPosition < containerBottom - 20 && scrollPosition >= containerOffset - 20) {
            $(link).addClass("active");
          } else {
            $(link).removeClass("active");
          }
        });
      }
    };

    $(document).ready(function() {
      
      util.scrollMenuIds = $("a.nav-link[href]");
      $("#menu").click(util.mobileMenu);
      $(window).resize(util.windowResize);
      $(document).scroll(util.scrollEvent);
      
    });
</script>
    <?php $conn->close() ?>

</html>
