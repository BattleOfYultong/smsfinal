<section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 text-center text-white">
      <div class="fade-in-up">
        <div class="stat-counter">5K+</div>
        <p class="text-lg opacity-90">Active Students</p>
      </div>
      <div class="fade-in-up" style="animation-delay: 0.1s;">
        <div class="stat-counter">200+</div>
        <p class="text-lg opacity-90">Faculty Members</p>
      </div>
      <div class="fade-in-up" style="animation-delay: 0.2s;">
        <div class="stat-counter">50+</div>
        <p class="text-lg opacity-90">Classrooms</p>
      </div>
      
    </div>
  </div>
</section><script>
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll('.stat-counter');
  let started = false; 

  const startCounting = () => {
    if (started) return; 
    counters.forEach(counter => {
      const target = parseInt(counter.innerText.replace(/[^0-9]/g, ''));
      let count = 0;
      const duration = 1500;
      const step = Math.ceil(target / (duration / 16));

      const update = () => {
        count += step;
        if (count >= target) {
          counter.innerText = counter.innerText.includes('%') ? target + '%' : target + '+';
        } else {
          counter.innerText = counter.innerText.includes('%') ? count + '%' : count + '+';
          requestAnimationFrame(update);
        }
      };
      update();
    });

    started = true;
  };

  const observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) startCounting();
  }, { threshold: 0.4 });

  observer.observe(document.querySelector('.stat-counter'));
});
</script>