const menuBtn = document.getElementById("menuBtn");
const navLinks = document.getElementById("navLinks");

if (menuBtn && navLinks) {
    menuBtn.addEventListener("click", () => {
        navLinks.classList.toggle("show");
    });
}

const revealElements = document.querySelectorAll(".reveal");

function revealOnScroll() {
    revealElements.forEach((element) => {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;
        const revealPoint = 120;

        if (elementTop < windowHeight - revealPoint) {
            element.classList.add("active");
        }
    });
}

window.addEventListener("scroll", revealOnScroll);
window.addEventListener("load", revealOnScroll);

const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const placeItems = document.querySelectorAll(".place-item");

function filterPlaces() {
    const searchText = searchInput ? searchInput.value.toLowerCase() : "";
    const selectedCategory = categoryFilter ? categoryFilter.value : "all";

    placeItems.forEach((item) => {
        const placeName = item.querySelector("h3").textContent.toLowerCase();
        const category = item.getAttribute("data-category");

        const matchesSearch = placeName.includes(searchText);
        const matchesCategory = selectedCategory === "all" || selectedCategory === category;

        if (matchesSearch && matchesCategory) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}

if (searchInput) {
    searchInput.addEventListener("keyup", filterPlaces);
}

if (categoryFilter) {
    categoryFilter.addEventListener("change", filterPlaces);
}

const autoSliderFrame = document.getElementById("autoSliderFrame");
const autoSliderImage = document.getElementById("autoSliderImage");
const detailsHero = document.getElementById("detailsHero");
const sliderDots = document.querySelectorAll("#sliderDots span");

if (autoSliderFrame && autoSliderImage) {
    let images = [];

    try {
        images = JSON.parse(autoSliderFrame.getAttribute("data-images"));
    } catch (error) {
        images = [];
    }

    let currentIndex = 0;

    if (images.length > 1) {
        setInterval(() => {
            currentIndex++;

            if (currentIndex >= images.length) {
                currentIndex = 0;
            }

            autoSliderImage.style.opacity = "0";

            setTimeout(() => {
                autoSliderImage.src = images[currentIndex];

                if (detailsHero) {
                    detailsHero.style.backgroundImage =
                        "linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.65)), url('" +
                        images[currentIndex] +
                        "')";
                }

                sliderDots.forEach((dot) => {
                    dot.classList.remove("active");
                });

                if (sliderDots[currentIndex]) {
                    sliderDots[currentIndex].classList.add("active");
                }

                autoSliderImage.style.opacity = "1";
            }, 500);
        }, 3000);
    }
}


// Single frame public gallery slider
const singleGalleryImage = document.getElementById("singleGalleryImage");
const singleGalleryTitle = document.getElementById("singleGalleryTitle");
const singleGalleryPlace = document.getElementById("singleGalleryPlace");
const singleGalleryDescription = document.getElementById("singleGalleryDescription");
const singleGalleryDate = document.getElementById("singleGalleryDate");
const galleryCurrentNumber = document.getElementById("galleryCurrentNumber");
const galleryPrevBtn = document.getElementById("galleryPrevBtn");
const galleryNextBtn = document.getElementById("galleryNextBtn");
const singleGalleryThumbs = document.querySelectorAll(".single-gallery-thumb");

if (
    typeof gallerySliderData !== "undefined" &&
    gallerySliderData.length > 0 &&
    singleGalleryImage
) {
    let singleGalleryIndex = 0;

    function showSingleGalleryImage(index) {
        if (index < 0) {
            index = gallerySliderData.length - 1;
        }

        if (index >= gallerySliderData.length) {
            index = 0;
        }

        singleGalleryIndex = index;
        const item = gallerySliderData[singleGalleryIndex];

        singleGalleryImage.style.opacity = "0";

        setTimeout(() => {
            singleGalleryImage.src = item.image;
            singleGalleryImage.alt = item.title;

            if (singleGalleryTitle) {
                singleGalleryTitle.textContent = item.title;
            }

            if (singleGalleryPlace) {
                singleGalleryPlace.textContent = item.place;
            }

            if (singleGalleryDescription) {
                singleGalleryDescription.textContent = item.description;
            }

            if (singleGalleryDate) {
                singleGalleryDate.textContent = item.uploaded_at;
            }

            if (galleryCurrentNumber) {
                galleryCurrentNumber.textContent = singleGalleryIndex + 1;
            }

            singleGalleryThumbs.forEach((thumb) => {
                thumb.classList.remove("active");
            });

            if (singleGalleryThumbs[singleGalleryIndex]) {
                singleGalleryThumbs[singleGalleryIndex].classList.add("active");
                singleGalleryThumbs[singleGalleryIndex].scrollIntoView({
                    behavior: "smooth",
                    inline: "center",
                    block: "nearest"
                });
            }

            singleGalleryImage.style.opacity = "1";
        }, 220);
    }

    if (galleryPrevBtn) {
        galleryPrevBtn.addEventListener("click", () => {
            showSingleGalleryImage(singleGalleryIndex - 1);
        });
    }

    if (galleryNextBtn) {
        galleryNextBtn.addEventListener("click", () => {
            showSingleGalleryImage(singleGalleryIndex + 1);
        });
    }

    singleGalleryThumbs.forEach((thumb) => {
        thumb.addEventListener("click", () => {
            const index = parseInt(thumb.getAttribute("data-index"));
            showSingleGalleryImage(index);
        });
    });
}


// Home page admin uploaded cover auto slider
(function () {
    const hero = document.getElementById("adminCoverHero");
    if (!hero) return;
    let coverImages = [];
    try { coverImages = JSON.parse(hero.getAttribute("data-cover-images")); } catch (error) { coverImages = []; }
    if (!Array.isArray(coverImages) || coverImages.length === 0) return;
    let index = 0;
    function setHeroImage(imagePath) {
        hero.style.backgroundImage = "linear-gradient(rgba(0,0,0,0.42), rgba(0,0,0,0.72)), url('" + imagePath + "')";
    }
    setHeroImage(coverImages[0]);
    if (coverImages.length > 1) {
        setInterval(() => { index++; if (index >= coverImages.length) index = 0; setHeroImage(coverImages[index]); }, 4000);
    }
})();
