import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import store from "@/store/index";

const routes: Array<RouteRecordRaw> = [
  {
    path: "/auth/login",
    name: "AuthLogin",
    component: () => import("@/views/auth/Login.vue"),
  },
  {
    path: "/adminer",
    name: "AdminerIndex",
    component: () => import("@/views/adminer/Index.vue"),
  },
  {
    path: "/adminer/:id",
    name: "AdminerUpdate",
    component: () => import("@/views/adminer/Update.vue"),
  },
  {
    path: "/adminer/store",
    name: "AdminerStore",
    component: () => import("@/views/adminer/Store.vue"),
  },

  {
    path: "/material",
    name: "MaterialIndex",
    component: () => import("@/views/mst-material/Index.vue"),
  },
  {
    path: "/material/update/:id",
    name: "MaterialUpdate",
    component: () => import("@/views/mst-material/Update.vue"),
  },
  {
    path: "/material/store",
    name: "MaterialStore",
    component: () => import("@/views/mst-material/Store.vue"),
  },
  {
    path: "/taste",
    name: "TasteIndex",
    component: () => import("@/views/mst-taste/Index.vue"),
  },
  {
    path: "/taste/update/:id",
    name: "TasteUpdate",
    component: () => import("@/views/mst-taste/Update.vue"),
  },
  {
    path: "/taste/store",
    name: "TasteStore",
    component: () => import("@/views/mst-taste/Store.vue"),
  },
  {
    path: "/symptom",
    name: "SymptomIndex",
    component: () => import("@/views/mst-symptom/Index.vue"),
  },
  {
    path: "/symptom/update/:id",
    name: "SymptomUpdate",
    component: () => import("@/views/mst-symptom/Update.vue"),
  },
  {
    path: "/symptom/store",
    name: "SymptomStore",
    component: () => import("@/views/mst-symptom/Store.vue"),
  },
  
  //flavor start
  {
    path: "/flavor",
    name: "FlavorIndex",
    component: () => import("@/views/mst-flavor/Index.vue"),
  },
  {
    path: "/flavor/update/:id",
    name: "FlavorUpdate",
    component: () => import("@/views/mst-flavor/Update.vue"),
  },
  {
    path: "/flavor/store",
    name: "FlavorStore",
    component: () => import("@/views/mst-flavor/Store.vue"),
  },
  //flarvor end

  {
    path: "/product-category",
    name: "ProductCategoryIndex",
    component: () => import("@/views/product-category/Index.vue"),
  },
  {
    path: "/product-category/update/:id",
    name: "ProductCategoryUpdate",
    component: () => import("@/views/product-category/Update.vue"),
  },
  {
    path: "/product-category/store",
    name: "ProductCategoryStore",
    component: () => import("@/views/product-category/Store.vue"),
  },
  {
    path: "/product",
    name: "ProductIndex",
    component: () => import("@/views/product/Index.vue"),
  },
  {
    path: "/product/update/:id",
    name: "ProductUpdate",
    component: () => import("@/views/product/Update.vue"),
  },
  {
    path: "/product/store",
    name: "ProductStore",
    component: () => import("@/views/product/Store.vue"),
  },
  {
    path: "/order",
    name: "OrderIndex",
    component: () => import("@/views/order/Index.vue"),
  },
  {
    path: "/order/:id",
    name: "OrderShow",
    component: () => import("@/views/order/Show.vue"),
  },
  {
    path: "/therapist",
    name: "TherapistIndex",
    component: () => import("@/views/therapist/Index.vue"),
  },
  {
    path: "/therapist/:id",
    name: "TherapistUpdate",
    component: () => import("@/views/therapist/Update.vue"),
  },
  {
    path: "/therapist/store",
    name: "TherapistStore",
    component: () => import("@/views/therapist/Store.vue"),
  },
  {
    path: "/therapist-blog",
    name: "TherapistBlogIndex",
    component: () => import("@/views/therapist-blog/Index.vue"),
  },
  {
    path: "/therapist-blog/:id",
    name: "TherapistBlogUpdate",
    component: () => import("@/views/therapist-blog/Update.vue"),
  },
  {
    path: "/therapist-blog/store",
    name: "TherapistBlogStore",
    component: () => import("@/views/therapist-blog/Store.vue"),
  },
  {
    path: "/product-recommendation/:kind",
    name: "ProductRecommendationIndex",
    component: () => import("@/views/product-recommendation/Index.vue"),
  },
  {
    path: "/page/news",
    name: "PageNews",
    component: () => import("@/views/page/News.vue"),
  },
  {
    path: "/page/healing",
    name: "PageHealing",
    component: () => import("@/views/page/Healing.vue"),
  },
  {
    path: "/page/inspiration",
    name: "PageInspiration",
    component: () => import("@/views/page/Inspiration.vue"),
  },
  {
    path: "/page/maintenance",
    name: "PageMaintenance",
    component: () => import("@/views/page/Maintenance.vue"),
  },
  {
    path: "/page/home",
    name: "PageHome",
    component: () => import("@/views/page/Home.vue"),
  },
  {
    path: "/page/therapist-blog",
    name: "PageTherapistBlog",
    component: () => import("@/views/page/TherapistBlog.vue"),
  },
  {
    path: "/page/about",
    name: "PageAbout",
    component: () => import("@/views/page/About.vue"),
  },
  {
    path: "/page/faq-image",
    name: "PageFaq",
    component: () => import("@/views/page/Faq.vue"),
  },
  {
    path: "/page/faq-category",
    name: "FaqCategoryIndex",
    component: () => import("@/views/faq-category/Index.vue"),
  },
  {
    path: "/page/faq-category/store",
    name: "FaqCategoryStore",
    component: () => import("@/views/faq-category/Store.vue"),
  },
  {
    path: "/page/faq-category/:id",
    name: "FaqCategoryUpdate",
    component: () => import("@/views/faq-category/Update.vue"),
  },
  {
    path: "/page/faq",
    name: "FaqIndex",
    component: () => import("@/views/faq/Index.vue"),
  },
  {
    path: "/page/faq/store",
    name: "FaqStore",
    component: () => import("@/views/faq/Store.vue"),
  },
  {
    path: "/page/faq/:id",
    name: "FaqUpdate",
    component: () => import("@/views/faq/Update.vue"),
  },
  {
    path: "/coupon",
    name: "CouponIndex",
    component: () => import("@/views/coupon/Index.vue"),
  },
  {
    path: "/coupon/store",
    name: "CouponStore",
    component: () => import("@/views/coupon/Store.vue"),
  },
  {
    path: "/coupon/:id",
    name: "CouponUpdate",
    component: () => import("@/views/coupon/Update.vue"),
  },
  {
    path: "/user/mail-magazine",
    name: "MailMagazine",
    component: () => import("@/views/user/MailMagazine.vue"),
  },
  {
    path: "/user",
    name: "UserIndex",
    component: () => import("@/views/user/Index.vue"),
  },
  {
    path: "/user/:id",
    name: "UserShow",
    component: () => import("@/views/user/Show.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach(async (to, from, next): Promise<void> => {
  await store.dispatch("setAuthData");
  if (to.name !== "AuthLogin" && !store.state.isLogin) {
    next("/auth/login");
    return;
  }
  next();
});

export default router;
