import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    // Elements
    const sidebarToggle = document.getElementById("sidebarToggle"); // Button to toggle sidebar
    const sidebar = document.getElementById("sidebar"); // Sidebar element
    const overlay = document.getElementById("overlay"); // Overlay for mobile screens

    // Function to toggle the sidebar
    const toggleSidebar = () => {
        const isOpen = sidebar.classList.contains("translate-x-0");
        if (isOpen) {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
            overlay.classList.add("hidden");
        } else {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            overlay.classList.remove("hidden");
        }
    };

    // Function to close the sidebar
    const closeSidebar = () => {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");
        overlay.classList.add("hidden");
    };

    // Event listeners
    sidebarToggle.addEventListener("click", toggleSidebar);
    overlay.addEventListener("click", closeSidebar);

    // Handle default state on larger screens (open on desktop/tablet, closed on mobile)
    const handleResize = () => {
        if (window.innerWidth >= 768) {
            // Medium and large screens (tablet and desktop): sidebar is open by default
            sidebar.classList.add("translate-x-0");
            sidebar.classList.remove("-translate-x-full");
            overlay.classList.add("hidden");
        } else {
            // Small screens (mobile): sidebar is closed initially
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
            overlay.classList.add("hidden");
        }
    };

    // Check screen size on load and resize
    handleResize();
    window.addEventListener("resize", handleResize);
});
