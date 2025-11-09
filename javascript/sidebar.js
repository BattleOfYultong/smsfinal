
        // Section toggle function
        function toggleSection(sectionId) {
            const section = document.getElementById(`${sectionId}-section`);
            const icon = document.getElementById(`${sectionId}-icon`);
            
            if (section.classList.contains('hidden')) {
                section.classList.remove('hidden');
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-down');
            } else {
                section.classList.add('hidden');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-right');
            }
        }

        // Sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileCloseBtn = document.getElementById('mobile-close-btn');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mainContent = document.getElementById('main-content');
        const collapseBtn = document.getElementById('collapse-btn');

        // Mobile menu toggle
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        }

        // Close mobile menu
        function closeMobileMenu() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        if (mobileCloseBtn) {
            mobileCloseBtn.addEventListener('click', closeMobileMenu);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeMobileMenu);
        }

        // Desktop collapse toggle with content adjustment
        if (collapseBtn) {
            let isCollapsed = false;
            collapseBtn.addEventListener('click', () => {
                isCollapsed = !isCollapsed;
                const icon = collapseBtn.querySelector('i');
                
                if (isCollapsed) {
                    sidebar.classList.add('collapsed-sidebar');
                    mainContent.classList.remove('lg:ml-64');
                    mainContent.classList.add('lg:ml-[4.5rem]');
                    icon.classList.remove('fa-angles-left');
                    icon.classList.add('fa-angles-right');
                } else {
                    sidebar.classList.remove('collapsed-sidebar');
                    mainContent.classList.remove('lg:ml-[4.5rem]');
                    mainContent.classList.add('lg:ml-64');
                    icon.classList.remove('fa-angles-right');
                    icon.classList.add('fa-angles-left');
                }
            });
        }

        // Menu search functionality
        const menuSearch = document.getElementById('menu-search');
        if (menuSearch) {
            menuSearch.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const menuItems = document.querySelectorAll('.menu-item');
                
                menuItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        item.style.display = 'flex';
                        item.classList.add('animate-slide-in');
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Close sidebar on mobile when clicking a link
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeMobileMenu();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                if (!sidebarOverlay.classList.contains('hidden')) {
                    closeMobileMenu();
                }
            }
        });

        // Active link highlighting
        const currentPage = window.location.pathname.split('/').pop();
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentPage) {
                item.classList.add('bg-blue-50', 'text-blue-900', 'font-medium');
            }
        });
   