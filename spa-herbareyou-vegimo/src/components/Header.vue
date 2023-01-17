<template>
  <header class="header">
    <div
      class="news"
      style="display: block"
      v-if="news && isShowDisplayNewsToPage()"
    >
      <p class="news__txt">
        {{ news }}
      </p>
    </div>
    <div class="header-flex">
      <div class="nav-toggle">
        <div class="nav-toggle__inner" v-on:click="openMenu()">
          <span class="nav-toggle__bar"></span>
          <span class="nav-toggle__bar"></span>
          <span class="nav-toggle__bar"></span>
        </div>
      </div>
      <h1 class="header-logo">
        <router-link
          class="header-logo__inner"
          v-on:click="closeMenu()"
          :to="{ name: 'Home' }"
        >
          <img
            class="header-logo__img"
            src="@/assets/img/common/logo-o.svg"
            alt=""
          />
        </router-link>
      </h1>
      <div class="icons">
        <router-link class="icons__inner js-search-open" to="">
          <img class="icons__img" src="@/assets/img/common/icon1.svg" alt="" />
        </router-link>
        <router-link
          v-on:click="closeMenu()"
          :to="{ name: 'MyPageLogin' }"
          class="icons__inner"
          v-if="!$store.state.isLogin"
        >
          <img class="icons__img" src="@/assets/img/common/icon2.svg" alt="" />
        </router-link>

        <router-link
          v-on:click="closeMenu()"
          :to="{ name: 'MyPageRegistered' }"
          class="icons__inner js-cart-mypage"
          v-else
        >
          <img class="icons__img" src="@/assets/img/common/icon2.svg" alt="" />
        </router-link>

        <a class="icons__inner js-cart-open" href="">
          <img class="icons__img" src="@/assets/img/common/icon3.svg" alt="" />
          <p class="icons__amount" v-if="$store.state.cart.total_num !== 0">
            {{ $store.state.cart.total_num }}
          </p>
        </a>
      </div>
    </div>
    <nav class="nav">
      <div class="nav-inner">
        <div class="nav-inner__left">
          <ul class="nav-list">
            <li class="nav-list-item">
              <span class="nav-list-item__txt nav-list-item__txt--mb30"
                >商品をさがす</span
              >
              <ul class="child-list">
                <li class="child-list-item">
                  <router-link
                    class="child-list-item__link child-list-item__link--mb30"
                    v-on:click="closeMenu()"
                    :to="{ name: 'ProductIndex' }"
                    >商品一覧</router-link
                  >
                </li>

                <li class="child-list-item">
                  <router-link
                    class="child-list-item__link child-list-item__link--mb30"
                    v-on:click="closeMenu()"
                    :to="{ name: 'Home', hash: '#detailedSymptomBlock' }"
                    >具体的な症状・テーマから探す</router-link
                  >
                </li>

                <li class="child-list-item">
                  <span class="child-list-item__txt child-list-item__txt--mb20"
                    >今の気分に合わせて探す</span
                  >
                  <ul class="gran-child-list">
                    <li class="gran-child-list-item">
                      <a
                        href="/product/category/2"
                        class="gran-child-list-item__link gran-child-list-item__link--mb20"
                        >INSPIRATION　<br class="sp" />閃きや活力が欲しい時に</a
                      >
                    </li>
                    <li class="gran-child-list-item">
                      <a
                        href="/product/category/3"
                        class="gran-child-list-item__link gran-child-list-item__link--mb20"
                        >MAINTENANCE　<br
                          class="sp"
                        />いつもの自分を取り戻すために</a
                      >
                    </li>
                    <li class="gran-child-list-item">
                      <a
                        href="/product/category/1"
                        class="gran-child-list-item__link gran-child-list-item__link--mb20"
                        >HEALING　<br class="sp" />具体的な症状・不調に</a
                      >
                    </li>
                  </ul>
                </li>
                <li class="child-list-item">
                  <a
                    href="/trialset"
                    class="child-list-item__link child-list-item__link--mb30"
                    tabindex="-1"
                    >初めての方へ　お試しアソートセット</a
                  >
                </li>
                <li class="child-list-item">
                  <a
                    class="child-list-item__link child-list-item__link--mb30"
                    tabindex="-1"
                    >プレゼント＆ギフトBOX<span
                      class="child-list-item__link-span"
                      >近日公開</span
                    ></a
                  >
                </li>
                <li class="child-list-item">
                  <router-link
                    class="child-list-item__link child-list-item__link--mb30"
                    v-on:click="closeMenu()"
                    to="/#this_month_herb_tee"
                    >今月のおすすめハーブティ</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="nav-inner__right">
          <ul class="nav-list">
            <li class="nav-list-item">
              <a
                class="nav-list-item__link nav-list-item__link--mb50"
                tabindex="-1"
                href="/diagnose"
                >ハーブティ診断を受ける</a>
            </li>
            <li class="nav-list-item">
              <router-link
                class="nav-list-item__link nav-list-item__link--mb50"
                v-on:click="closeMenu()"
                :to="{
                  name: 'BlogIndex',
                }"
                >植物療法士便り</router-link
              >
            </li>
            <li class="nav-list-item">
              <router-link
                class="nav-list-item__link nav-list-item__link--mb50"
                v-on:click="closeMenu()"
                to="/about/"
              >
                HERB ARE YOU?について</router-link
              >
            </li>
            <li class="nav-list-item">
              <router-link
                class="nav-list-item__link nav-list-item__link--mb50"
                v-on:click="closeMenu()"
                :to="{
                  name: 'SiteFaq',
                }"
                >よくあるご質問</router-link
              >
            </li>
            <li class="nav-list-item">
              <router-link
                class="nav-list-item__link nav-list-item__link--mb50"
                v-on:click="closeMenu()"
                :to="{ name: 'MyPageRegistered' }"
                >マイページ</router-link
              >
            </li>
            <li class="nav-list-item">
              <router-link
                class="nav-list-item__link nav-list-item__link--mb50"
                v-on:click="closeMenu()"
                :to="{ name: 'CartIndex' }"
                >カートを見る</router-link
              >
            </li>

            <li class="nav-list-item">
              <router-link
                class="nav-list-item__link nav-list-item__link--mb50"
                v-on:click="closeMenu()"
                :to="{ name: 'Diagnose0' }"
                >お問合せ</router-link
              >
            </li>
          </ul>
        </div>
        <div class="sns">
          <a class="sns__item" href="https://www.instagram.com/herbareyou/"
            >Instagram</a
          >
          <a class="sns__item" href="https://www.facebook.com/herbareyou.jp"
            >Facebook</a
          >
        </div>
      </div>
    </nav>
    <div class="s-cart">
      <div class="s-cart__container">
        <div class="s-cart__header">
          <p class="s-cart__header-ttl">
            カート（{{ $store.state.cart.total_num }}）
          </p>
          <a class="s-cart__close js-cart-close"></a>
        </div>
        <div
          class="s-cart__content"
          v-for="(cartDetail, index) in $store.state.cart_details"
          v-bind:key="index"
        >
          <p class="s-cart__sub">{{ cartDetail.product.category.name }}</p>
          <p class="s-cart__ttl">
            <span class="s-cart__ttl-num">{{
              cartDetail.product.product_no
            }}</span>
            <span class="s-cart__ttl-main"
              >{{ cartDetail.product.name1 }}<br />{{
                cartDetail.product.name2
              }}</span
            >
          </p>
          <p class="s-cart__herb">
            {{
              pageService.cutText(
                20,
                "…",
                pageService.implode(
                  "、",
                  pageService.pluck("name", cartDetail.product.materials)
                )
              )
            }}
          </p>
          <div class="s-cart__flex">
            <div class="s-cart__left">
              <img
                :src="cartDetail.product.upload_files[0]?.url ?? ''"
                alt=""
              />
            </div>
            <div class="s-cart__right">
              <div class="counter">
                <div
                  class="counter__left js-counter-down"
                  v-on:click="
                    countDown(cartDetail.product_price_id, cartDetail.num)
                  "
                >
                  −
                </div>
                <input
                  type="text"
                  name="amount"
                  :value="cartDetail.num"
                  class="counter__amount"
                  v-on:change="
                    changeProductNum($event, cartDetail.product_price_id)
                  "
                />
                <div
                  class="counter__right js-counter-up"
                  v-on:click="
                    countUp(cartDetail.product_price_id, cartDetail.num)
                  "
                >
                  ＋
                </div>
              </div>
              <div class="acd-select">
                <div class="acd-select__head">
                  <p class="acd-select__txt">
                    {{ cartDetail.product_price.capacity }} ¥{{
                      cartDetail.product_price.price
                    }}
                  </p>
                  <div class="acd-select__taxin js-acdSelect-btn">Tax in</div>
                </div>
                <input
                  type="hidden"
                  name="amount"
                  class="acd-select__input"
                  value=""
                />
                <ul class="acd-select__list">
                  <li
                    id=""
                    class="acd-select__item"
                    v-for="price in cartDetail.product.prices"
                    v-bind:key="price.id"
                    v-on:click="
                      changeProductPrice(
                        cartDetail.product_price_id,
                        price.id,
                        cartDetail.num
                      )
                    "
                  >
                    {{ price.capacity }} ¥{{ price.price }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="s-cart__footer">
          <p class="s-cart__total">Total</p>
          <p class="s-cart__total-price">
            ¥{{ $store.state.cart.total_product_price }} Tax in
          </p>
        </div>
        <div class="b-btn">
          <button class="b-btn__btn" v-on:click="toPurchasePage()">購入</button>
        </div>
      </div>
    </div>

    <div class="search">
      <div class="search__container">
        <input
          type="search"
          name="search"
          placeholder=""
          class="search__input"
        />
        <button
          class="search__btn"
          onclick="window.location.href='/searchresult'"
        ></button>
      </div>
      <a href="" class="search__close js-search-close">
        <span class="search__close-bar"></span>
        <span class="search__close-bar"></span>
      </a>
    </div>
  </header>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { PageService } from "@/services/PageService";
import { CommonScriptService } from "@/services/CommonScriptService";
// import { upadteCartDetailNumApi } from "@/api/carts";
import { firstContentApi } from "@/api/contents";

import // upadteCartDetailProductPriceApi,
// destroyCartDetailApi,
"@/api/carts";
import { addProductPriceData, deleteProductPriceData } from "@/utils/cart";

export default defineComponent({
  name: "Header",
  props: ["isUpdate"],
  watch: {
    isUpdate: {
      handler: function ($newData, oldData) {
        if ($newData) {
          // this.setData();
        }
      },
      deep: true,
    },
  },
  data() {
    return {
      carts: [] as any[],
      news: "",
      pageService: new PageService(),
      commonScriptService: new CommonScriptService(),
      $store: this.$store as any,
    };
  },
  components: {},
  created: async function () {},
  beforeRouteUpdate: function (to, from, next) {
    next();
    this.closeMenu();
  },
  mounted: async function (): Promise<void> {
    this.setLogoColor();
    if (this.isShowDisplayNewsToPage()) {
      const result = await firstContentApi("news");
      if (!result.success) {
        this.commonError(result);
        return;
      }
      this.news = result.data.content;
    }
    this.$nextTick(function () {
      this.commonScriptService.df13();
      this.commonScriptService.df14();
    });
  },
  methods: {
    commonError: function (result: any = null): void {
      if (result.status === 422) {
        this.validateErrors = result.data;
      }
      if (result.message !== "") {
        this.message = result.message;
      }
    },
    countUp: async function (
      cartDetailId: number,
      nowNum: number
    ): Promise<void> {
      addProductPriceData(cartDetailId, 1);
      await this.$store.dispatch("setCartData");
    },
    countDown: async function (
      cartDetailId: number,
      nowNum: number
    ): Promise<void> {
      addProductPriceData(cartDetailId, -1);
      await this.$store.dispatch("setCartData");
    },
    // 個数はそのままで商品を交換する
    changeProductPrice: async function (
      oldPriceId: number,
      selectPriceId: number,
      num: number
    ): Promise<void> {
      addProductPriceData(oldPriceId, -1 * num);
      addProductPriceData(selectPriceId, num);
      await this.$store.dispatch("setCartData");
    },
    // upadteCartDetailNum: async function (
    //   cartDetailId: number,
    //   num: number
    // ): Promise<void> {
    //   const cartApiResult = await upadteCartDetailNumApi(cartDetailId, num);
    //   if (!cartApiResult.success) {
    //     alert("カートの更新に失敗しました");
    //     return;
    //   }
    //   await this.$store.dispatch("setCartData");
    // },
    // upadteCartDetailProductPrice: async function (
    //   cartDetailId: number,
    //   productPriceId: number
    // ): Promise<void> {
    //   const cartApiResult = await upadteCartDetailProductPriceApi(
    //     cartDetailId,
    //     productPriceId
    //   );
    //   if (!cartApiResult.success) {
    //     alert("カートの更新に失敗しました");
    //     return;
    //   }
    //   await this.$store.dispatch("setCartData");
    // },
    // destroyCartDetail: async function (cartDetailId: number): Promise<void> {
    //   const cartApiResult = await destroyCartDetailApi(cartDetailId);
    //   if (!cartApiResult.success) {
    //     alert("カートの更新に失敗しました");
    //     return;
    //   }
    //   await this.$store.dispatch("setCartData");
    // },
    toPurchasePage: function (): void {
      this.$router.push("/cart");
    },
    setLogoColor: function (): void {
      var header: any = document.querySelector(".header");
      var navToggle: any = document.querySelector(".nav-toggle");
      var navToggleBars: any = document.querySelectorAll(".nav-toggle__bar");
      var headerLogoImage: any = document.querySelector(".header-logo__img");
      var iconImages: any = document.querySelectorAll(".icons__img");

      const pathName = window.location.pathname;
      console.log("pathName", window.location);
      if(pathName === "/product" || pathName==="/product/" || pathName === '/' || pathName === '/blog' || pathName === '/blog/' || pathName === '/product/:id' || pathName === '/product/:id/')
      {
        navToggleBars.forEach(function (bar: any) {
              bar.style.backgroundColor = "#d6ac4e";
            });
        headerLogoImage.setAttribute("src", "/img/common/logo-o.svg");
        iconImages[0].setAttribute("src", "/img/common/icon1.svg");
        iconImages[1].setAttribute("src", "/img/common/icon2.svg");
        iconImages[2].setAttribute("src", "/img/common/icon3.svg");
      }
      else{
        navToggleBars.forEach(function (bar: any) {
              bar.style.backgroundColor = "#d6ac4e";
            });
        headerLogoImage.setAttribute("src", "/img/common/logo-o.svg");
        iconImages[0].setAttribute("src", "/img/common/icon1.svg");
        iconImages[1].setAttribute("src", "/img/common/icon2.svg");
        iconImages[2].setAttribute("src", "/img/common/icon3.svg");
      }

      if (
        pathName === "/diagnose" ||
        pathName === "/diagnose/" ||
        pathName === "/diagnose0" ||
        pathName === "/diagnose0/" ||
        pathName === "/diagnose1" ||
        pathName === "/diagnose1/" ||
        pathName === "/diagnose2" ||
        pathName === "/diagnose2/" ||
        pathName === "/diagnose3" ||
        pathName === "/diagnose3/" ||
        pathName === "/diagnose4" ||
        pathName === "/diagnose4/" ||
        pathName === "/diagnose5" ||
        pathName === "/diagnose5/" ||
        pathName === "/diagnose6" ||
        pathName === "/diagnose6/" ||
        pathName === "/diagnoseproduct" ||
        pathName === "/diagnoseproduct/" ||
        pathName === "/diagnose-result" ||
        pathName === "/diagnose-result/"
      ) {
        navToggleBars.forEach(function (bar: any) {
          bar.style.backgroundColor = "#FFF";
        });
        headerLogoImage.setAttribute("src", "/img/common/logo-w.svg");
        iconImages[0].setAttribute("src", "/img/common/icon1-w.svg");
        iconImages[1].setAttribute("src", "/img/common/icon2-w.svg");
        iconImages[2].setAttribute("src", "/img/common/icon3-w.svg");
        navToggle.addEventListener("click", function () {
          if (header.classList.contains("is-open")) {
            navToggleBars.forEach(function (bar: any) {
              bar.style.backgroundColor = "#d6ac4e";
            });
            headerLogoImage.setAttribute("src", "/img/common/logo-o.svg");
            iconImages[0].setAttribute("src", "/img/common/icon1.svg");
            iconImages[1].setAttribute("src", "/img/common/icon2.svg");
            iconImages[2].setAttribute("src", "/img/common/icon3.svg");
          } else {
            navToggleBars.forEach(function (bar: any) {
              bar.style.backgroundColor = "#FFF";
            });
            headerLogoImage.setAttribute("src", "/img/common/logo-w.svg");
            iconImages[0].setAttribute("src", "/img/common/icon1-w.svg");
            iconImages[1].setAttribute("src", "/img/common/icon2-w.svg");
            iconImages[2].setAttribute("src", "/img/common/icon3-w.svg");
          }
        });
      }
    },
    closeMenu: function () {
      var headerLogo: any = document.querySelector(".header-logo");
      var nav: any = document.querySelector(".nav");
      nav.classList.toggle("is-open");
      headerLogo.style.display = "block";
    },
    openMenu: function () {
      var header: any = document.querySelector(".header");
      var nav: any = document.querySelector(".nav");
      var headerLogo: any = document.querySelector(".header-logo");
      header.classList.toggle("is-open");
      nav.classList.toggle("is-open");
      if (nav.classList.contains("is-open")) {
        headerLogo.style.display = "none";
      } else {
        headerLogo.style.display = "block";
      }
    },
    isShowDisplayNewsToPage: function () {
      return this.$route.name === "Home";
    },
    // 直接入力された個数の変更
    changeProductNum: async function (
      event: any,
      cartDetailId: number
    ): Promise<void> {
      const num = Number(event.target.value);
      if (isNaN(num) || num < 0) {
        alert("正の整数を入力してください");
        return;
      }
      deleteProductPriceData(cartDetailId);
      addProductPriceData(cartDetailId, num);
      await this.$store.dispatch("setCartData");
    },
  },
});
</script>
<style scoped></style>
