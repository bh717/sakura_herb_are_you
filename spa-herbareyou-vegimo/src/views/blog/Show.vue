<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article v-if="isShow">
        <section class="sec">
          <div class="sec-container">
            <h2 class="sec-container__hd2" data-anime="fadeup">
              <span class="sec-container__hd2-issue">植物療法士便り #{{ pageService.get0Padding(blog.id, 2) }}</span>
              <span class="sec-container__hd2-title">{{ blog.title }}</span>
              <span class="sec-container__hd2-author">{{ blog.therapist.name }} {{ blog.therapist.name_kana }}</span>
            </h2>
            <p class="sec-container__txt br" data-anime="fadeup">
              {{ blog.body }}
            </p>
            <div class="sec-container__img" data-anime="fadeup">
              <img :src="blog.upload_files[0].url" alt="" />
            </div>
            <!-- <div v-bind:style="{ 'display':`flex`, 'gap':`10px`, 'overflow-x':`auto`, 'width':`30rem`}" v-if="items.upload_file_hashs.length !== 0">
              <div v-for="imageUrl in blog.upload_files">
                <img :src="imageUrl.url" width="100" height="100"/>
              </div>
            </div>
            </div> -->
          </div>
        </section>
        <section class="sec" data-anime="fadeup">
          <div class="profile-container">
            <h3 class="profile-container__hd3">
              {{ blog.therapist.name }} {{ blog.therapist.name_kana }}
            </h3>
            <p class="profile-container__txt">
              {{ blog.therapist.profile }}
            </p>
            <div class="btn">
              <router-link to="/blog/" class="btn__all">一覧へ</router-link>
              <router-link :to="{
                name: 'BlogShow',
                params: { id: Number(blog.next_blog.id) },
              }" class="btn__next" v-if="blog.next_blog">次の記事へ</router-link>
            </div>
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

import { showTerapistBlogApi } from "@/api/terapist_blogs";

export default defineComponent({
  name: "BlogShow",
  watch: {},
  data() {
    return {
      isShow: false,
      message: "",
      blog: {} as any,

      commonScriptService: new CommonScriptService(),
      pageService: new PageService(),
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
    const showBlogApiResult = await showTerapistBlogApi(
      Number(this.$route.params.id)
    );
    if (!showBlogApiResult.success) {
      alert("失敗");
      return;
    }
    this.blog = showBlogApiResult.data;
    console.log("blog data:", this.blog);
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
    });
  },
  beforeRouteUpdate: async function (to, from, next): Promise<void> {
    const showBlogApiResult = await showTerapistBlogApi(Number(to.params.id));
    if (!showBlogApiResult.success) {
      alert("失敗");
      return;
    }
    this.blog = showBlogApiResult.data;
    next();
  },

  methods: {},
});
</script>
<style scoped src="@/assets/css/article.css"></style>
