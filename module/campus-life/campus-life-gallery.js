function buildCustomModal() {
    if (document.getElementById("customGalleryModal")) return;

    const modal = document.createElement("div");

    modal.id = "customGalleryModal";

    modal.innerHTML = `
        <div class="modal-overlay"></div>

        <div class="modal-box rb-dialog" id="gallery_dialog" role="dialog">
            <div class="rb-dialog__inner">

                <header>
                    <div id="modalTitle" class="rb-dialog__title"></div>

                    <button id="modalClose"
                        class="rb-button rb-button--borderless rb-button--icon rb-button--icon--before"
                        data-icon="close">
                        Close
                    </button>
                </header>

                <div class="modal-main-image">
                    <img id="modalMainImg" src="" loading="lazy">
                </div>

                <div class="modal-thumbs" id="modalThumbStrip"></div>

            </div>
        </div>
    `;

    document.body.appendChild(modal);

    document.getElementById("modalClose").onclick = closeCustomModal;

    document.querySelector(".modal-overlay").onclick = closeCustomModal;
}

function openCustomModal(index, slides, title) {

    const modal = document.getElementById("customGalleryModal");

    if (!modal) return;

    modal.classList.add("open");

    document.getElementById("modalTitle").innerText = title;

    loadMainImage(index, slides);

    loadThumbnails(slides, index);
}

function loadMainImage(index, slides) {

    document.getElementById("modalMainImg").src = slides[index].url;

    document.querySelectorAll(".modal-thumb-item").forEach(el => {
        el.classList.remove("active");
    });

    const activeThumb = document.querySelector(
        `.modal-thumb-item[data-index="${index}"]`
    );

    if (activeThumb) {
        activeThumb.classList.add("active");
    }
}

function loadThumbnails(slides, activeIndex) {

    const container = document.getElementById("modalThumbStrip");

    container.innerHTML = "";

    slides.forEach((slide, i) => {

        container.innerHTML += `
            <div class="modal-thumb-item ${i === activeIndex ? "active" : ""}"
                data-index="${i}">
                <img src="${slide.thumb}">
            </div>
        `;
    });

    document.querySelectorAll(".modal-thumb-item").forEach(thumb => {

        thumb.addEventListener("click", function () {

            loadMainImage(
                parseInt(this.dataset.index),
                slides
            );
        });
    });
}

function closeCustomModal() {

    document
        .getElementById("customGalleryModal")
        .classList.remove("open");
}

document.addEventListener("DOMContentLoaded", function () {

    buildCustomModal();

    // Gallery item click
    const galleryItems = document.querySelectorAll(".glightbox_item");

    galleryItems.forEach(item => {

        item.addEventListener("click", function (e) {

            e.preventDefault();

            const galleryKey = this.dataset.gallery;

            const items = document.querySelectorAll(
                `.glightbox_item[data-gallery="${galleryKey}"]`
            );

            const slides = [];

            items.forEach(el => {

                slides.push({
                    url: el.dataset.full,
                    thumb: el.dataset.thumb,
                    title: el.dataset.title
                });
            });

            const index = parseInt(this.dataset.index);

            openCustomModal(index, slides, this.dataset.title);
        });
    });

    // Gallery mode button click
    const btns = document.querySelectorAll(".uoy-gallery-mode-btn");

    btns.forEach(btn => {

        btn.addEventListener("click", function () {

            const galleryKey = this.dataset.gallery;

            const firstItem = document.querySelector(
                `.glightbox_item[data-gallery="${galleryKey}"]`
            );

            if (firstItem) {
                firstItem.click();
            }
        });
    });

});