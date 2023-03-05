<template>
  <div>
    <footer class="footer" v-if="!isSct">
      <small>Copyright © HERBAREYOU? All Rights Reserved.</small>
    </footer>

    <footer class="footer-about" v-if="isSct">
      <div class="sec-container">
        <div class="sec-sub-container">
          <p class="footer-about-title">商品をさがす</p>
          <router-link
            v-if="isSct"
            class="footer-about__link"
            :to="{ name: 'ProductIndex' }"
          >
            - 商品一覧
          </router-link>
          <a class="footer-about__link" href="/product/category/2">
            - INSPILATION　閃きや活力が欲しい時に
          </a>
          <a class="footer-about__link" href="/product/category/3">
            - MEDITATION　いつもの自分を取り戻すために
          </a>
          <a class="footer-about__link" href="/product/category/1">
            - HEELING　具体的な症状・不調に
          </a>

          <router-link
            v-if="isSct"
            class="footer-about__link"
            :to="{
              name: 'TrialSetIndex',
            }"
          >
            - 初めての方へ　お試しアソートセット
          </router-link>
          <a class="footer-about__link"> - プレゼント＆ギフトBOX </a>

          <router-link
            v-if="isSct"
            class="footer-about__link"
            to="/#this_month_herb_tee"
          >
            - 今月のおすすめハーブティ
          </router-link>
        </div>

        <div class="sec-sub-container">
          <div class="sub-container">
            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{
                name: 'Diagnose0',
              }"
            >
              ハーブティ診断を受ける
            </router-link>

            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{
                name: 'BlogIndex',
              }"
            >
              植物療法士便り
            </router-link>

            <router-link v-if="isSct" class="footer-about__link" to="/about/my-section">
              HERB ARE YOU?について
            </router-link>
          </div>

          <div class="sub1-container">
            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{ name: 'MyPageRegistered' }"
            >
              マイページ
            </router-link>

            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{ name: 'CartIndex' }"
            >
              カートを見る
            </router-link>
          </div>
        </div>

        <div class="sec-sub-container">
          <div class="sub-container">
            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{
                name: 'SiteFaq',
              }"
            >
              よくあるご質問
            </router-link>

            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{
                name: 'SiteAbout',
                params: { id: 'my-section2' },
              }"
            >
              お問合せフォーム
            </router-link>

            <router-link
              v-if="isSct"
              class="footer-about__link"
              :to="{
                name: 'SiteSct',
              }"
            >
              特定商取引に基づく表記│利用規約
            </router-link>
          </div>

          <div class="sub1-container">
            <a
              v-if="isSct"
              class="footer-about__link"
              href="https://www.facebook.com/herbareyou.jp"
            >
              Facebook
            </a>

            <a
              v-if="isSct"
              class="footer-about__link"
              href="https://www.instagram.com/herbareyou/"
            >
              Instagram
            </a>
          </div>
        </div>
      </div>
    </footer>

    <footer class="footer-end" v-if="isSct">
      <router-link
        v-if="isSct"
        class="footer-about__link"
        :to="{
          name: 'SiteSct',
        }"
      >
        Copyright © HERBAREYOU? All Rights Reserved.
      </router-link>
    </footer>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    isSct: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
});
</script>
<style scoped>
.footer-about {
  text-align: center;
  width: 100%;
  padding: 3rem 0 8rem;
  background-color: #f7f7f7;
}
.footer-about-title {
  margin-bottom: 1rem;
}
.footer-end {
  text-align: center;
  width: 100%;
  padding: 3rem 0 3rem;
  background-color: white;
}

.footer-about__link {
  color: #707070;
  margin-bottom: 1rem;
}

.sec-container {
  width: 85%;
  margin: auto;
  padding: 5rem 0 8rem;
  text-align: center;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.sec-sub-container {
  display: flex;
  flex-direction: column;
  text-align: left;
}

.sub-container {
  display: flex;
  flex-direction: column;
}

.sub1-container {
  margin-top: 1rem;
  display: flex;
  flex-direction: column;
}

@media screen and (max-width: 768px) {
  .sec-container {
    flex-direction: column;
    row-gap: 4rem;
  }
}

@media screen and (max-width: 599px) {
  .sec-container {
    flex-direction: column;
    row-gap: 4rem;
  }
}
</style>
