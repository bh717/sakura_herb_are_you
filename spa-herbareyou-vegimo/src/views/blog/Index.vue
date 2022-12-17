<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="kv-container">
            <picture>
              <source
                media="(max-width:599px)"
                :srcset="
                  cloudFrontBaseurl +
                  'assets/img/therapist-blog/top-sp.jpg?' +
                  dateTime
                "
              />
              <img
                :src="
                  cloudFrontBaseurl +
                  'assets/img/therapist-blog/top.jpg?' +
                  dateTime
                "
                class="kv-container__img"
                alt=""
              />
            </picture>
            <h2 class="kv-container__hd2">植物療法士便り</h2>
          </div>
        </section>
        <section class="sec">
          <div class="sec-container">
            <ul class="blog-list">
              <li
                class="blog-item"
                data-anime="fadeup"
                v-for="blog in blogs"
                v-bind:key="blog.id"
              >
                <router-link
                  :to="{
                    name: 'BlogShow',
                    params: { id: Number(blog.id) },
                  }"
                  class="blog-item-link"
                >
                  <span class="blog-item-link__issue"
                    >植物療法士便り #{{
                      pageService.get0Padding(blog.id, 2)
                    }}</span
                  >
                  <h3 class="blog-item-link__hd3">{{ blog.title }}</h3>
                </router-link>
              </li>
            </ul>
          </div>
        </section>
      </article>
    </main>
    <Footer />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { CommonScriptService } from "@/services/CommonScriptService";
import { PageService } from "@/services/PageService";
// import { Messages } from "@/consts/Messages";
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";

import { indexTerapistBlogApi } from "@/api/terapist_blogs";

export default defineComponent({
  name: "BlogIndex",
  watch: {},
  data() {
    return {
      isShow: false,
      message: "",
      blogs: [] as any[],
      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),

      cloudFrontBaseurl: process.env.VUE_APP_CLOUD_FRONT_BASE_URL,
      dateTime: Date.now(),
    };
  },
  components: {
    Footer,
    Header,
    ValidateError,
  },
  created: async function () {},
  mounted: async function (): Promise<void> {
    document.body.className = "purchase";
    const blogApiResult = await indexTerapistBlogApi();
    if (!blogApiResult.success) {
      alert("失敗");
      return;
    }
    this.blogs = blogApiResult.data;
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },

  methods: {},
});
</script>
<style scoped src="@/assets/css/blog.css"></style>
