document.addEventListener('DOMContentLoaded', function() {
    
    // =========================================================
    // 1. Mobile Menu Toggler (NEW)
    // =========================================================
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const mainNavList = document.getElementById('main-nav-list');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            // Toggle the 'active' class on the nav element
            mainNav.classList.toggle('active');
            
            // Toggle the accessibility attribute
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            
            // Optionally change the icon (e.g., from bars to X)
            const icon = menuToggle.querySelector('i');
            if (mainNav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close menu when a link is clicked (for smooth scrolling)
        mainNavList.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.querySelector('i').classList.remove('fa-times');
                menuToggle.querySelector('i').classList.add('fa-bars');
            });
        });
    }

    // =========================================================
    // 2. Smooth Scrolling for Navigation Links
    // =========================================================
    const navLinks = document.querySelectorAll('.main-nav a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Offset by 70px to account for the fixed header height
                window.scrollTo({
                    top: targetElement.offsetTop - 70, 
                    behavior: 'smooth'
                });
            }
        });
    });

    // =========================================================
    // 3. Dynamic Testimonial Carousel (Horizontal Scroll for LTR)
    // =========================================================
    const slider = document.querySelector('.testimonials-slider');
    const testimonials = document.querySelectorAll('.testimonial');
    const totalTestimonials = testimonials.length;

    if (slider && totalTestimonials > 1) {
        let currentIndex = 0;
        
        // Calculate the width: testimonial width + margin (20px from CSS)
        const testimonialWidth = testimonials[0].offsetWidth + 20; 

        function moveSlider() {
            // Increment index, looping back to 0
            currentIndex = (currentIndex + 1) % totalTestimonials;
            
            // Positive offset works correctly for LTR, pushing content left
            const offset = -currentIndex * testimonialWidth;
            
            // Apply the horizontal translation
            slider.style.transition = 'transform 1s ease-in-out';
            slider.style.transform = `translateX(${offset}px)`;

            // Handle the smooth loop back to the start
            if (currentIndex === totalTestimonials - 1) {
                 // After the transition finishes (1000ms), reset the position instantly
                setTimeout(() => {
                    currentIndex = -1; // Set to -1 so the next moveSlider call goes to 0
                    slider.style.transition = 'none';
                    slider.style.transform = `translateX(0)`; 
                    
                    // Force a reflow for the transition change to register immediately
                    void slider.offsetWidth; 
                }, 1000); 
            }
        }

        // Set the automatic scrolling interval (switches every 5 seconds)
        setInterval(moveSlider, 5000); 
    }

    // =========================================================
    // 4. Header Scroll Behavior (Adds Shadow)
    // =========================================================
    const header = document.querySelector('.main-header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });


    // =========================================================
    // 5. Counter Animation (English Suffixes)
    // =========================================================
    const counters = document.querySelectorAll('.counter');
    let hasCounted = false; 

    const countUp = (counter) => {
        const target = +counter.getAttribute('data-target');
        
        // Logic to determine the suffix based on the English label text
        const label = counter.parentElement.querySelector('.stat-label').textContent;
        const countSuffix = label.includes('Employment Rate') ? '%' : 
                            label.includes('Nationalities') ? '+' : 
                            label.includes('Ratio') ? ':1' : 
                            '';
                            
        const duration = 2000; 
        let start = 0;

        const step = target / (duration / 10); 

        const updateCount = () => {
            if (start < target) {
                start += step;
                // Use Math.ceil to round up for smooth counting
                counter.textContent = Math.ceil(start);
                requestAnimationFrame(updateCount);
            } else {
                // Ensure the final target value is displayed exactly
                counter.textContent = target; 
                
                // Add the correct suffix
                if (countSuffix) {
                    counter.textContent += countSuffix;
                }
            }
        };

        updateCount();
    };

    const options = {
        root: null, 
        rootMargin: '0px',
        threshold: 0.5 
    };

    // Create an observer instance
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasCounted) {
                counters.forEach(countUp);
                hasCounted = true; 
                observer.unobserve(entry.target); 
            }
        });
    }, options);

    // Start observing the #impact section
    const impactSection = document.getElementById('impact');
    if (impactSection) {
        observer.observe(impactSection);
    }
    
});