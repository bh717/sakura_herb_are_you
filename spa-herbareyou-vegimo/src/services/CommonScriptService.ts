export class CommonScriptService {
  constructor() {
    // this.exit();
  }

  execute() {
    this.df1();
    this.df2();
    this.df3();
    // this.df4();
    this.df17();
    this.df5();
    this.df6();
    this.df7();
    this.df8();
    this.df9();
    // this.df10();
    this.df11();
    // this.df12();
    // this.df13();
    this.df14();
    this.df15();
    this.df16();
  }

  // newsShow
  df1(): void {
    var news: any = document.querySelector(".news");
    if (
      window.location.href === process.env.VUE_APP_BASE_URL,
      news?.style?.display
    ) {
      news.style.display = "block";
    }
  }

  // headerSticky
  df2(): void {
    var news: any = document.querySelector(".news");
    var newsHeight: number = 0;
    if (news) {
      newsHeight = news.clientHeight;
    }
    var headerFlex: any = document.querySelector(".header-flex");
    window.addEventListener("scroll", function () {
      var scroll = window.pageYOffset;
      if (scroll >= newsHeight) {
        headerFlex.classList.add("is-fixed");
      } else if (scroll === 0) {
        headerFlex.classList.remove("is-fixed");
      }
    });
  }

  // headerFixed(except index)
  df3(): void {
    var header: any = document.querySelector(".header");
    if (window.location.href !== process.env.VUE_APP_BASE_URL) {
      header.style.position = "fixed";
    }
  }

  // hamburger
  df4(): void {
    var header: any = document.querySelector(".header");
    var navToggle: any = document.querySelector(".nav-toggle__inner");
    var nav: any = document.querySelector(".nav");
    var headerLogo: any = document.querySelector('.header-logo');
    navToggle.addEventListener("click", function () {
      header.classList.toggle("is-open");
      nav.classList.toggle("is-open");
      if (nav.classList.contains('is-open')) {
        headerLogo.style.display = 'none';
      } else {
        headerLogo.style.display = 'block';
      }
    });
  }

  // acd
  df5(): void {
    var titles = document.querySelectorAll(".js-accordion-title");
    var contents = document.querySelectorAll(".accordion__content");
    var lists = document.querySelectorAll(".sort-inner-list");
    var _loop = function _loop(i: number) {
      titles[i].addEventListener("click", function (e: any) {
        e.preventDefault();
        titles[i].classList.toggle("is-active");
        contents[i].classList.toggle("is-open");
        lists[i].classList.toggle("is-active");
      });
    };
    for (var i = 0; i < titles.length; i++) {
      _loop(i);
    }
  }

  // sCartOpen
  df6(): void {
    var openBtn: any = document.querySelector(".js-cart-open");
    var closeBtn: any = document.querySelector(".js-cart-close");
    var sCart: any = document.querySelector(".s-cart");
    openBtn.addEventListener("click", function (e: any) {
      e.preventDefault();
      sCart.classList.add("is-active");
    });
    closeBtn.addEventListener("click", function (e: any) {
      e.preventDefault();
      sCart.classList.remove("is-active");
    });
  }

  // acd-select
  df7(): void {
    var selectors = document.querySelectorAll(".acd-select");
    var _loop2 = function _loop2(i: number) {
      var selector: any = selectors[i];
      var items: any = selector.querySelectorAll(".acd-select__item");
      var txt: any = selector.querySelector(".acd-select__txt");
      var input: any = selector.querySelector(".acd-select__input");
      var btn: any = selector.querySelector(".js-acdSelect-btn");
      var list: any = selector.querySelector(".acd-select__list");
      var _loop3 = function _loop3(_i: number) {
        items[_i].addEventListener("click", function () {
          txt.textContent = items[_i].textContent;

          var selectId = items[_i].getAttribute("id");

          input.setAttribute("value", selectId);
          list.classList.remove("is-open");
          btn.classList.toggle("is-active");
        });
      };
      for (var _i = 0; _i < items.length; _i++) {
        _loop3(_i);
      }
      btn.addEventListener("click", function () {
        list.classList.toggle("is-open");
        btn.classList.toggle("is-active");
      });
    };
    for (var i = 0; i < selectors.length; i++) {
      _loop2(i);
    }
  }

  // acd-select-exc
  df8(): void {
    var selectors = document.querySelectorAll(".acd-select-exc");
    var _loop4 = function _loop4(i: number) {
      var selector: any = selectors[i];
      var items: any = selector.querySelectorAll(".acd-select-exc__item");
      var txt: any = selector.querySelector(".acd-select-exc__txt");
      var input: any = selector.querySelector(".acd-select-exc__input");
      var btn: any = selector.querySelector(".js-acdSelectExc-btn");
      var list: any = selector.querySelector(".acd-select-exc__list");
      var _loop5 = function _loop5(_i2: number) {
        items[_i2].addEventListener("click", function () {
          txt.textContent = items[_i2].textContent;
          var selectId = items[_i2].getAttribute("id");
          input.setAttribute("value", selectId);
          list.classList.remove("is-open");
          btn.classList.toggle("is-active");
        });
      };
      for (var _i2 = 0; _i2 < items.length; _i2++) {
        _loop5(_i2);
      }
      btn.addEventListener("click", function () {
        list.classList.toggle("is-open");
        btn.classList.toggle("is-active");
      });
    };
    for (var i = 0; i < selectors.length; i++) {
      _loop4(i);
    }
  }

  // delivery-select
  df9(): void {
    var selector: any = document.querySelector(".delivery-select");
    var btn: any = document.querySelector(".js-deliverySelect-btn");
    var list: any = document.querySelector(".delivery-select__list");
    var items: any = document.querySelectorAll(".delivery-select__item");
    var txt: any = document.querySelector(".delivery-select__txt");
    var input: any = document.querySelector(".delivery-select__input");
    var _loop6 = function _loop6(i: number) {
      items[i].addEventListener("click", function () {
        txt.textContent = items[i].textContent;
        var selectId = items[i].getAttribute("id");
        input.setAttribute("value", selectId);
        list.classList.remove("is-open");
        btn.classList.toggle("is-active");
      });
    };
    for (var i = 0; i < items.length; i++) {
      _loop6(i);
    }
    if (!btn) {
      return;
    }
    btn.addEventListener("click", function (e: any) {
      e.preventDefault();
      list.classList.toggle("is-open");
      btn.classList.toggle("is-active");
    });
  }

  // // counter
  // df10(): void {
  //     var downBtns: any = document.querySelectorAll(".js-counter-down");
  //     var upBtns: any = document.querySelectorAll(".js-counter-up");
  //     var amounts: any = document.querySelectorAll(".counter__amount");
  //     var countNum: any = 1;
  //     var _loop7 = function _loop7(i: number) {
  //         upBtns[i].addEventListener("click", function () {
  //             countNum++;
  //             amounts[i].value = countNum;
  //             amounts[i].textContent = countNum;
  //             amounts[i].setAttribute("value", countNum);
  //         });
  //         downBtns[i].addEventListener("click", function () {
  //             if (1 < countNum) {
  //                 countNum--;
  //                 amounts[i].value = countNum;
  //                 amounts[i].innerHTML = countNum;
  //                 amounts[i].setAttribute("value", countNum);
  //             }
  //         });
  //     };
  //     for (var i = 0; i < upBtns.length; i++) {
  //         _loop7(i);
  //     }
  // }

  // counter-exc
  df11(): void {
    var downBtns: any = document.querySelectorAll(".js-counter-down-exc");
    var upBtns: any = document.querySelectorAll(".js-counter-up-exc");
    var amounts: any = document.querySelectorAll(".counter-exc__amount");
    var countNum: any = 1;
    var _loop8 = function _loop8(i: number) {
      upBtns[i].addEventListener("click", function () {
        countNum++;
        amounts[i].value = countNum;
        amounts[i].textContent = countNum;
        amounts[i].setAttribute("value", countNum);
      });
      downBtns[i].addEventListener("click", function () {
        if (1 < countNum) {
          countNum--;
          amounts[i].value = countNum;
          amounts[i].innerHTML = countNum;
          amounts[i].setAttribute("value", countNum);
        }
      });
    };
    for (var i = 0; i < upBtns.length; i++) {
      _loop8(i);
    }
  }

  // //diagnoseChangeHeader
  // df12(): void {
  //   var header: any = document.querySelector(".header");
  //   var navToggle: any = document.querySelector(".nav-toggle");
  //   var navToggleBars: any = document.querySelectorAll(".nav-toggle__bar");
  //   var headerLogoImage: any = document.querySelector(".header-logo__img");
  //   var iconImages: any = document.querySelectorAll(".icons__img");
  //   if (
  //     window.location.href === "https://hay.harph-stg.xyz/diagnose/" ||
  //     window.location.href ===
  //       "https://hay.harph-stg.xyz/diagnose/diagnose-1/" ||
  //     window.location.href ===
  //       "https://hay.harph-stg.xyz/diagnose/diagnose-2/" ||
  //     window.location.href ===
  //       "https://hay.harph-stg.xyz/diagnose/diagnose-3/" ||
  //     window.location.href ===
  //       "https://hay.harph-stg.xyz/diagnose/diagnose-4/" ||
  //     window.location.href ===
  //       "https://hay.harph-stg.xyz/diagnose/diagnoseresult/"
  //   ) {
  //     navToggleBars.forEach(function (bar: any) {
  //       bar.style.backgroundColor = "#fff";
  //     });
  //     headerLogoImage.setAttribute("src", "@/img/common/logo-w.svg");
  //     iconImages[0].setAttribute("src", "@/img/common/icon1-w.svg");
  //     iconImages[1].setAttribute("src", "@/img/common/icon2-w.svg");
  //     iconImages[2].setAttribute("src", "@/img/common/icon3-w.svg");
  //     navToggle.addEventListener("click", function () {
  //       if (header.classList.contains("is-open")) {
  //         navToggleBars.forEach(function (bar: any) {
  //           bar.style.backgroundColor = "#d6ac4e";
  //         });
  //         headerLogoImage.setAttribute("src", "@/img/common/logo-o.svg");
  //         iconImages[0].setAttribute("src", "@/img/common/icon1.svg");
  //         iconImages[1].setAttribute("src", "@/img/common/icon2.svg");
  //         iconImages[2].setAttribute("src", "@/img/common/icon3.svg");
  //       } else {
  //         navToggleBars.forEach(function (bar: any) {
  //           bar.style.backgroundColor = "#fff";
  //         });
  //         headerLogoImage.setAttribute("src", "/img/common/logo-w.svg");
  //         iconImages[0].setAttribute("src", "/img/common/icon1-w.svg");
  //         iconImages[1].setAttribute("src", "/img/common/icon2-w.svg");
  //         iconImages[2].setAttribute("src", "/img/common/icon3-w.svg");
  //       }
  //     });
  //   }
  // }

  // isScrolling
  df13(): void {
    // var nav = document.querySelector('.nav');
    var headerFlex: any = document.querySelector('.header-flex');
      if (!headerFlex) {
        return;
      }
      if (!headerFlex.style) {
        return;
      }
    var isScrolling: number = 0;
    var timeoutId;
    window.addEventListener("scroll", function () {
      isScrolling = 1;
      headerFlex.style.opacity = 0;
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function () {
        isScrolling = 0;
        headerFlex.style.opacity = 1;
      }, 100);
    });
  }

  //fadeUp
  df14(): void {
    var fadeUps = document.querySelectorAll("[data-anime]");
    var options = {
      root: null,
      rootMargin: "0px 0px",
      threshold: 0.05,
    };
    var observer = new IntersectionObserver(callback, options);
    fadeUps.forEach(function (tgt) {
      observer.observe(tgt);
    });
    function callback(entries: any) {
      entries.forEach(function (entry: any, i: number) {
        var target = entry.target;

        if (entry.isIntersecting && !target.classList.contains("is-active")) {
          var delay = i * 100;
          setTimeout(function () {
            target.classList.add("is-active");
          }, delay);
        }
      });
    }
  }

  //openSearch
  df15(): void {
    var isScrollingElms: any = document.querySelectorAll(".js-isScrolling-elm");
    var openBtn: any = document.querySelector(".js-search-open");
    var closeBtn: any = document.querySelector(".js-search-close");
    var search: any = document.querySelector(".search");
    if (openBtn) {
      openBtn.addEventListener("click", function (e: any) {
      e.preventDefault();
      search.classList.add("is-open");
      if (search.classList.contains("is-open")) {
        for (var i = 0; i <= isScrollingElms.length; i++) {
          isScrollingElms[i].style.display = 'none';
        }
      }
      if (closeBtn) {
        closeBtn.addEventListener("click", function (elm: any) {
          e.preventDefault();
          elm.style.display = "block";
          search.classList.remove("is-open");
        });
      }
    });
    }

  }

  // sp-sort-display
  df16(): void {
    var spFilterBtns: any = document.querySelector(".sp-filer-btn");
    var sortLeft: any = document.querySelector(".sort-left");

    if (!spFilterBtns || !sortLeft) {
      return;
    }
    spFilterBtns.addEventListener("click", function (e: any) {
      e.preventDefault();
      sortLeft.classList.add("is-active");
    });
  }

  // sp-sort-display
  df17(): void {
    //faq_acd
    let title = document.querySelectorAll(".js-accordion-title-faq");
    let _loop = function _loop(i) {
      let titleEach = title[i];
      let content = titleEach.nextElementSibling;
      if (!content) {
        return;
      }
      let list = content.children;
      console.log("content", content);
      titleEach.addEventListener("click", function (e) {
        e.preventDefault();
        titleEach.classList.toggle("is-active");
        if (content) {
          content.classList.toggle("is-open");
        }
        list[i].classList.toggle("is-active");
      });
    };
    for (let i = 0; i < title.length; i++) {
      _loop(i);
    }
  }
}
