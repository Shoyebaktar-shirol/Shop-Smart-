
        document.addEventListener("DOMContentLoaded", function() {
            const carousel = document.querySelector(".carousel");
            const totalImages = document.querySelectorAll(".carousel img").length;
            const pagination = document.querySelector(".pagination");
            let currentIndex = 0;

            // Create pagination dots
            for (let i = 0; i < totalImages; i++) {
                const dot = document.createElement("button");
                dot.classList.add("pagination-dot");
                if (i === 0) dot.classList.add("active");
                pagination.appendChild(dot);
            }

            const dots = document.querySelectorAll(".pagination-dot");

            function slideCarousel() {
                currentIndex = (currentIndex + 1) % totalImages;
                carousel.style.transform = `translateX(-${currentIndex * 100 / totalImages}%)`;
                updatePagination();
            }

            function updatePagination() {
                dots.forEach(dot => dot.classList.remove("active"));
                dots[currentIndex].classList.add("active");
            }

            document.getElementById("next").addEventListener("click", slideCarousel);

            document.getElementById("prev").addEventListener("click", function() {
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                carousel.style.transform = `translateX(-${currentIndex * 100 / totalImages}%)`;
                updatePagination();
            });

            setInterval(slideCarousel, 2000); // Change image every 2 seconds
        });
    