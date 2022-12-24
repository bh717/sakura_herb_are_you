<template>
  <div class="mt-1 mb-3" v-if="$store.state.isLogin">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <span class="navbar-brand">herbareyou管理画面</span>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                管理データ
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'MaterialIndex' }"
                    >材料一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'MaterialStore' }"
                    >材料作成</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TasteIndex' }"
                    >味一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TasteStore' }"
                    >味作成</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'SymptomIndex' }"
                    >症状一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'SymptomStore' }"
                    >症状作成</router-link
                  >
                </li>

                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'FlavorIndex' }"
                    >香り一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'FlavorStore' }"
                    >香り作成</router-link
                  >
                </li>

                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'CouponIndex' }"
                    >coupon一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'CouponStore' }"
                    >coupon作成</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                商品
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'ProductCategoryIndex' }"
                    >カテゴリ一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'ProductCategoryStore' }"
                    >カテゴリ作成</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'ProductIndex' }"
                    >商品一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'ProductStore' }"
                    >商品作成</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{
                      name: 'ProductRecommendationIndex',
                      params: { kind: 2 },
                    }"
                    >INSPIRATION(前向きな今日に)</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{
                      name: 'ProductRecommendationIndex',
                      params: { kind: 3 },
                    }"
                    >MAINTENANCE(なんとなくのもやもやに)</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{
                      name: 'ProductRecommendationIndex',
                      params: { kind: 1 },
                    }"
                    >HEALING(具体的な症状・不調に)</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{
                      name: 'ProductRecommendationIndex',
                      params: { kind: 4 },
                    }"
                    >今月のおすすめハーブティー</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                注文
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'OrderIndex' }"
                    >注文一覧</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                セラピスト
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistIndex' }"
                    >セラピスト一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistStore' }"
                    >セラピスト作成</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistBlogIndex' }"
                    >ブログ一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistBlogStore' }"
                    >ブログ作成</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                ページ
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'PageNews' }"
                    >ニュース</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'PageHealing' }"
                    >Healing</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'PageInspiration' }"
                    >Inspiration</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'PageMaintenance' }"
                    >Maintenance</router-link
                  >
                </li>
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'PageHome' }"
                    >Home</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'PageTherapistBlog' }"
                    >植物療法士便り</router-link
                  >
                </li>
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'PageAbout' }"
                    >HerbAreYouについて</router-link
                  >
                </li>
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'PageFaq' }"
                    >faq
                  </router-link>
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'FaqCategoryIndex' }"
                    >faqカテゴリ一覧
                  </router-link>
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'FaqCategoryStore' }"
                    >faqカテゴリ作成
                  </router-link>
                </li>
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'FaqIndex' }"
                    >faq一覧
                  </router-link>
                </li>
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'FaqStore' }"
                    >faq作成
                  </router-link>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                セラピスト
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistIndex' }"
                    >セラピスト一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistStore' }"
                    >セラピスト作成</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistBlogIndex' }"
                    >ブログ一覧</router-link
                  >
                </li>
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'TherapistBlogStore' }"
                    >ブログ作成</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink1"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                ユーザー
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink1"
              >
                <li>
                  <router-link
                    class="dropdown-item"
                    :to="{ name: 'MailMagazine' }"
                    >メールマガジン</router-link
                  >
                </li>
                <li>
                  <router-link class="dropdown-item" :to="{ name: 'UserIndex' }"
                    >ユーザー一覧</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { AuthService } from "@/services/AuthService";

export default defineComponent({
  name: "Header",
  props: [],
  watch: {},
  data() {
    return {
      $store: this.$store as any,
      authService: new AuthService(),
    };
  },
  components: {},
  created: async function () {},
  mounted: async function (): Promise<void> {},
  methods: {
    logout: function () {
      this.authService.logout();
      this.$router.push({
        name: "AuthLogin",
      });
    },
  },
});
</script>
<style lang="scss" scoped>
.t1 {
  background-color: pink;
}
.t2 {
  background-color: orange;
}
.t3 {
  background-color: rgb(161, 255, 199);
}
.t4 {
  background-color: rgb(161, 214, 255);
}
a {
  color: black;
  text-decoration: none;
}
a:hover {
  color: black;
  text-decoration: none;
}
</style>
