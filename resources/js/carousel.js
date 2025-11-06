document.addEventListener('alpine:init', () => {
    Alpine.data('carousel', () => ({
        currentSlide: 0,
        interval: null,

        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % 3;
        },

        previousSlide() {
            this.currentSlide = (this.currentSlide - 1 + 3) % 3;
        },

        goToSlide(index) {
            this.currentSlide = index;
        },

        startAutoplay() {
            this.interval = setInterval(() => {
                this.nextSlide();
            }, 5000); // Change slide every 5 seconds
        },

        pauseAutoplay() {
            clearInterval(this.interval);
        }
    }));
});