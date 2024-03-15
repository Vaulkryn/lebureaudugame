/******************************************************************************/
/****** ALL MODULES USED IN APP WEB ******************************************/
/****************************************************************************/

/**************************************************************************/
/****** ↓↓ MODULES USED IN ALL PAGES ↓↓ **********************************/

/***************************************/
/***** ↓↓ Open/close login menu ↓↓ *****/

export function loginMenu() {
    function openLoginMenu() {
        $("#loginMenu").css("width", "325px");
    };

    function closeLoginMenu() {
        $("#loginMenu").css("width", "0");
    };

    $(document).ready(function () {
        $('#loginLink').click(function () {
            $('#menuOverlay').fadeIn();
            openLoginMenu();
        });
        $('#menuOverlay').click(function () {
            $(this).fadeOut();
            closeLoginMenu();
        });
    });
};

/**************************************/
/***** ↓↓ Open/close user menu ↓↓ *****/

export function userMenu() {
    function openUserMenu() {
        $("#userMenu").css("width", "350px");
    }

    function closeUserMenu() {
        $("#userMenu").css("width", "0");
    }

    $(document).ready(function () {
        $('#userMenuLink').click(function () {
            $('#menuOverlay').fadeIn();
            openUserMenu();
        });
        $('#menuOverlay').click(function () {
            $(this).fadeOut();
            closeUserMenu();
        });
    });
};

/*************************************/
/***** ↓↓ Open/close dropdown ↓↓ *****/

export function openCloseDropdown() {
    $('.dropdown').on('click', function () {
        var slide = $(this).next().find('.dropdown_list');
        slide.slideToggle();
    });
};

/**************************************************************************/
/****** ↓↓ MODULES USED IN INDEX.PHP ↓↓ **********************************/

/*******************************************/
/***** ↓↓ Fade in/out games_wrapper ↓↓ *****/

export function fadeInOutGamesWrapper() {
    const scrollingOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 1
    };
    function scrollingAnimate(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // fade in observed elements that are in view
                if (entry.target.classList.contains('fadeOutLeft')) {
                    entry.target.classList.replace('fadeOutLeft', 'fadeInLeft');
                }
                if (entry.target.classList.contains('fadeOutRight')) {
                    entry.target.classList.replace('fadeOutRight', 'fadeInRight');
                }
            } else {
                // fade out observed elements that are not in view
                if (entry.target.classList.contains('fadeInLeft')) {
                    entry.target.classList.replace('fadeInLeft', 'fadeOutLeft');
                }
                if (entry.target.classList.contains('fadeInRight')) {
                    entry.target.classList.replace('fadeInRight', 'fadeOutRight');
                }
            }
        });
    }
    const scrolling = new IntersectionObserver(scrollingAnimate, scrollingOptions);
    const fadeToLeft = document.querySelectorAll('.games_container');
    const fadeToRight = document.querySelectorAll('.category_container');
    fadeToLeft.forEach(el => scrolling.observe(el));
    fadeToRight.forEach(el => scrolling.observe(el));
}

/*********************************************/
/***** ↓↓ Carousel in games container ↓↓ *****/
/**
 * @param {HTMLElement} element
 * @param {Object} options
 * @param {Object} [options.slidesVisibles=1] nombres d'éléments visibles
 * @param {boolean} [options.loop=false] boucler ou non en fin de slides
 */
/**
 * @callback moveCallBack
 * @param {number} index
 */

export function slidingCarousel() {
    class Carousel {
        constructor(element, options = {}) {
            this.element = element
            this.options = Object.assign({}, {
                slidesToScroll: 1,
                slidesVisibles: 1,
                loop: false
            }, options)
            var children = [].slice.call(element.children)
            this.currentItem = 0
            this.root = this.createDivWithClass('carousel')
            this.container = this.createDivWithClass('carousel__container')
            this.root.appendChild(this.container)
            this.element.appendChild(this.root)
            this.moveCallBack = []
            this.items = children.map((child) => {
                var item = this.createDivWithClass('carousel__item')
                item.appendChild(child)
                this.container.appendChild(item)
                return item
            })
            this.setStyle()
            this.createNav()
            this.moveCallBack.forEach(callBack => callBack(0))
        }

        setStyle() {
            var ratio = this.items.length / this.options.slidesVisible
            this.container.style.width = (ratio * 100) + "%"
            this.items.length / this.options.slidesVisible
        }

        createNav() {
            var nextBtn = this.createDivWithClass('carousel__next')
            var prevBtn = this.createDivWithClass('carousel__prev')
            this.root.appendChild(nextBtn)
            this.root.appendChild(prevBtn)
            nextBtn.addEventListener('click', this.next.bind(this))
            prevBtn.addEventListener('click', this.prev.bind(this))
            if (this.options.loop === true) {
                return
            }
            this.onMove(index => {
                if (index === 0) {
                    prevBtn.classList.add('carousel__prev--hidden')
                } else {
                    prevBtn.classList.remove('carousel__prev--hidden')
                }
                if (this.items[this.currentItem + this.options.slidesVisible] === undefined) {
                    nextBtn.classList.add('carousel__next--hidden')
                } else {
                    nextBtn.classList.remove('carousel__next--hidden')
                }
            })
        }

        next() {
            this.gotoItem(this.currentItem + this.options.slidesToScroll)
        }

        prev() {
            this.gotoItem(this.currentItem - this.options.slidesToScroll)
        }

        /**
         * @param {number} index
         */

        gotoItem(index) {
            if (index < 0) {
                index = this.items.length - this.options.slidesVisible
            } else if (index >= this.items.length || this.items[this.currentItem + this.options.slidesVisible] === undefined && index > this.currentItem) {
                index = 0
            }
            var translateX = index * -100 / this.items.length
            this.container.style.transform = 'translate3d(' + translateX + '%,0,0)'
            this.currentItem = index
            this.moveCallBack.forEach(callBack => callBack(index))
        }

        /**
         * @param {moveCallBack} callBack 
         */

        onMove(callBack) {
            this.moveCallBack.push(callBack)
        }

        /**
         * @param {string} className
         * @returns {HTMLElement}
         */

        createDivWithClass(className) {
            var div = document.createElement('div')
            div.setAttribute('class', className)
            return div
        }
    }

    new Carousel(document.querySelector("#carusel1"), {
        slidesVisible: 3,
        loop: false
    })

    new Carousel(document.querySelector("#carusel2"), {
        slidesVisible: 3,
        loop: false
    })

    new Carousel(document.querySelector("#carusel3"), {
        slidesVisible: 3,
        loop: false
    })

    new Carousel(document.querySelector("#carusel4"), {
        slidesVisible: 3,
        loop: false
    })
}

/********************************************************/
/***** ↓↓ Fade in/out screenshot container & img ↓↓ *****/

export function containerFading() {
    var fadeInContainer = document.querySelectorAll(".reveal");
    for (var i = 0; i < fadeInContainer.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = fadeInContainer[i].getBoundingClientRect().top;
        var elementVisible = 450;
        if (elementTop < windowHeight - elementVisible) {
            fadeInContainer[i].classList.add("active");
        } else {
            fadeInContainer[i].classList.remove("active");
        }
    }
    window.addEventListener("scroll", containerFading);
}
export function imgFading() {
    var fadeInImgA = document.querySelectorAll(".revealImg");
    for (var i = 0; i < fadeInImgA.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = fadeInImgA[i].getBoundingClientRect().top;
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            fadeInImgA[i].classList.add("active");
        } else {
            fadeInImgA[i].classList.remove("active");
        }
    }
    window.addEventListener("scroll", imgFading);
}

/*****************************************************************************************/
/****** ↓↓ MODULES USED IN PAGES IN USER_SETTINGS FOLDER ↓↓ *****************************/

/*******************************************/
/***** ↓↓ Prevent resubmission form ↓↓ *****/

export function preventSubForm() {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}

/**********************************************/
/***** ↓↓ Prevent users to press enter ↓↓ *****/

export function preventToPressEnter() {
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
}

/*******************************************/
/***** ↓↓ Preview avatar img upload ↓↓ *****/

export function previewAvatar() {
    $(document).ready(function () {
        $("#upload_avatar").change(function () {
            readURL(this);
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#outputAvatar").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}

/*****************************************************************************************/
/****** ↓↓ MODULES USED IN PAGES IN USER_CONTENTS FOLDER ↓↓ *****************************/

/************************************/
/***** ↓↓ Custom File upload ↓↓ *****/

export function newInputDesign() {
    $('.inputUpload').each(function () {
        var $input = $(this),
            $label = $input.next('label'),
            labelVal = $label.html();

        $input.on('change', function (e) {
            var fileName = '';

            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else if (e.target.value)
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                $label.find('span').html(fileName);
            else
                $label.html(labelVal);
        });
        // Firefox bug fix
        $input
            .on('focus', function () {
                $input.addClass('has-focus');
            })
            .on('blur', function () {
                $input.removeClass('has-focus');
            });
    });
}

/************************************************/
/***** ↓↓ Preview Multiple Files Uploads ↓↓ *****/

export function previewMultipleImg() {
    if ($('#imgUpload').length > 0) {
        document.querySelector("#uploads").addEventListener("change", (e) => {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                const files = e.target.files;
                const output = document.querySelector("#output");
                output.innerHTML = "";
                for (let i = 0; i < files.length; i++) {
                    if (!files[i].type.match("image")) continue;
                    const picReader = new FileReader();
                    picReader.addEventListener("load", function (event) {
                        const picFile = event.target;
                        const div = document.createElement("div");
                        div.innerHTML = `<img class="outputImg" src="${picFile.result}" title="${picFile.name}"/>`;
                        output.appendChild(div);
                    });
                    picReader.readAsDataURL(files[i]);
                }
            } else {
                alert("Your browser does not support File API");
            }
        });
    }
}

/**********************************************/
/******** ↓↓ Change category options ↓↓ *******/

export function updateOptions() {
    var gameSelect = document.getElementsByName("game_name")[0];
    gameSelect.addEventListener("click", updateOptions);
    var categorySelect = document.getElementsByName("video_category")[0];
    var selectedGame = gameSelect.options[gameSelect.selectedIndex].value;
    switch (selectedGame) {
        case "EldenRing":
            categorySelect.options.length = 0;
            categorySelect.add(new Option("Boss"));
            categorySelect.add(new Option("Speedrun"));
            categorySelect.add(new Option("PvP"));
            break;
        case "SkyforceReloaded":
            categorySelect.options.length = 0;
            categorySelect.add(new Option("Insane Mode"));
            break;
    }
}

/*****************************************************************************************/
/****** ↓↓ MODULES USED IN ALL PAGES IN GAMES FOLDER ↓↓ *********************************/

/****************************************************/
/***** ↓↓ Display on left the selected video ↓↓ *****/

export function displayVideo() {
    var videoContent = document.querySelector(".video_container");
    var imgs = document.getElementsByClassName("dataImg");

    for (var i = 0; i < imgs.length; i++) {
        imgs[i].addEventListener("click", function () {
            var divId = this.getAttribute("data-id");
            var div = document.querySelector(`.video_content[data-id="${divId}"]`);
            videoContent.innerHTML = div.innerHTML;
        });
    }
}

/*****************************************************************************************/
/****** ↓↓ MODULES USED IN INDEX.PHP && ALL GAMES PAGES ↓↓ ******************************/

/****************************************************/
/***** ↓↓ Show & Close modals to display img ↓↓ *****/

export function openCloseModals() {
    function disableScroll() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        window.onscroll = function () { window.scrollTo(scrollLeft, scrollTop); };
    }
    function enableScroll() {
        window.onscroll = null;
    }
    var modal = document.getElementById('modalBody');
    var images = document.getElementsByClassName('img');
    var modalImg = document.getElementById("modalImg");
    for (var i = 0; i < images.length; i++) {
        var img = images[i];
        img.onclick = function (e) {
            modal.style.display = "block";
            modalImg.src = this.src;
            disableScroll();
        }
    }
    var closeBtn = document.getElementsByClassName("close")[0];
    closeBtn.onclick = function () {
        modal.style.display = "none";
        enableScroll();
    }
};