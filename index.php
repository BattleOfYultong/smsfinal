<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Management System</title>
  <link rel="icon" type="image/png" href="img/sms.png" />
     <?php include('landingheader.php') ?>
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .float-animation {
      animation: float 3s ease-in-out infinite;
    }

    .fade-in-up {
      animation: fadeInUp 0.8s ease-out forwards;
    }

    .slide-in {
      animation: slideIn 0.8s ease-out forwards;
    }

    .nav-link-hover {
      position: relative;
    }

    .nav-link-hover::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -4px;
      left: 50%;
      background: #3b82f6;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .nav-link-hover:hover::after {
      width: 100%;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .feature-card {
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-10px);
    }

    .stat-counter {
      font-size: 3rem;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .stat-counter {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<?php include_once('landings/nav.php') ?>
<!-- Hero Section -->
<?php include_once('landings/hero.php') ?>

<!-- Stats Section -->
<?php include_once('landings/stats.php') ?>

<!-- Core Features Section -->
<?php include_once('landings/core.php') ?>



<!-- About Us Section -->
<?php include_once('landings/about.php') ?>

<!-- Contact Us Section -->
<?php include_once('landings/contact.php') ?>
<!-- CTA Section -->


<!-- Footer Section -->
<?php include_once('landings/footer.php') ?>

</body>
<script>
  // Mobile menu toggle
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = mobileMenuBtn.querySelector('i');

  mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    if (mobileMenu.classList.contains('hidden')) {
      menuIcon.classList.remove('fa-times');
      menuIcon.classList.add('fa-bars');
    } else {
      menuIcon.classList.remove('fa-bars');
      menuIcon.classList.add('fa-times');
    }
  });

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
        // Close mobile menu if open
        mobileMenu.classList.add('hidden');
        menuIcon.classList.remove('fa-times');
        menuIcon.classList.add('fa-bars');
      }
    });
  });

  // Navbar scroll effect
  const navbar = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 50) {
      navbar.classList.add('shadow-xl');
    } else {
      navbar.classList.remove('shadow-xl');
    }
  });

  // Intersection Observer for fade-in animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('fade-in-up');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.feature-card').forEach(card => {
    observer.observe(card);
  });
</script>

</body>
</html>