import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import store from "@/store/index";

const routes: Array<RouteRecordRaw> = [
  { path: "/", name: "Home", component: () => import("@/views/Home.vue") },
  {
    path: "/mypage/registered",
    name: "MyPageRegistered",
    component: () => import("@/views/mypage/Registered.vue"),
  },
  {
    path: "/mypage/login",
    name: "MyPageLogin",
    component: () => import("@/views/mypage/Login.vue"),
  },
  {
    path: "/mypage/signup",
    name: "MyPageSignup",
    component: () => import("@/views/mypage/Signup.vue"),
  },
  {
    path: "/mypage/reissue",
    name: "MyPageReissue",
    component: () => import("@/views/mypage/Reissue.vue"),
  },
  {
    path: "/mypage/reset-password",
    name: "MyPageResetPassword",
    component: () => import("@/views/mypage/ResetPassword.vue"),
  },
  {
    path: "/mypage/delively-location",
    name: "MyPageDeliveryLocation",
    component: () => import("@/views/mypage/DeliveryLocation.vue"),
  },
  {
    path: "/product/category/:kind",
    name: "ProductIndexHealing",
    component: () => import("@/views/product/Index1.vue"),
  },
  {
    path: "/product/category/:kind",
    name: "ProductIndexInspiration",
    component: () => import("@/views/product/Index1.vue"),
  },
  {
    path: "/product/category/:kind",
    name: "ProductIndexMaintenance",
    component: () => import("@/views/product/Index1.vue"),
  },
  {
    path: "/product",
    name: "ProductIndex",
    component: () => import("@/views/product/Index.vue"),
  },
  {
    path: "/product/symptom",
    name: "SymptomIndex",
    component: () => import("@/views/product/Symptoms.vue"),
  },
  {
    path: "/product/:id",
    name: "ProductShow",
    component: () => import("@/views/product/Show.vue"),
  },
  {
    path: "/cart",
    name: "CartIndex",
    component: () => import("@/views/cart/Index.vue"),
  },
  {
    path: "/cart/purchase",
    name: "CartPurchase",
    component: () => import("@/views/cart/Purchase.vue"),
  },
  {
    path: "/faq",
    name: "SiteFaq",
    component: () => import("@/views/site/Faq.vue"),
  },
  {
    path: "/about",
    name: "SiteAbout",
    component: () => import("@/views/site/About.vue"),
  },
  {
    path: "/blog",
    name: "BlogIndex",
    component: () => import("@/views/blog/Index.vue"),
  },
  {
    path: "/blog/:id",
    name: "BlogShow",
    component: () => import("@/views/blog/Show.vue"),
  },
  {
    path: "/diagnose",
    name: "Diagnose0",
    component: () => import("@/views/diagnose/Diagnose0.vue"),
  },
  {
    path: "/diagnose1",
    name: "Diagnose1",
    component: () => import("@/views/diagnose/Diagnose1.vue"),
  },
  {
    path: "/diagnose2",
    name: "Diagnose2",
    component: () => import("@/views/diagnose/Diagnose2.vue"),
  },
  {
    path: "/diagnose3",
    name: "Diagnose3",
    component: () => import("@/views/diagnose/Diagnose3.vue"),
  },
  {
    path: "/diagnose4",
    name: "Diagnose4",
    component: () => import("@/views/diagnose/Diagnose4.vue"),
  },
  {
    path: "/diagnose5",
    name: "Diagnose5",
    component: () => import("@/views/diagnose/Diagnose5.vue"),
  },
  {
    path: "/diagnose-result",
    name: "DiagnoseResult",
    component: () => import("@/views/diagnose/DiagnoseResult.vue"),
  },
  {
    path: "/order-confirm",
    name: "ConfirmResult",
    component: () => import("@/views/cart/Confirm.vue"),
  },
  {
    path: "/site/sct",
    name: "SiteSct",
    component: () => import("@/views/site/Sct.vue"),
  },
  {
    path: "/trialset",
    name: "TrialSetIndex",
    component: () => import("@/views/trialset/index.vue"),
  },
  {
    path: "/error/500",
    name: "Error500",
    component: () => import("@/views/error/Error500.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach(async (to, from, next): Promise<void> => {
  await store.dispatch("setAuthData");
  await store.dispatch("setCartData");
  if (
    to.name !== "Home" &&
    to.name !== "MyPageLogin" &&
    to.name !== "MyPageSignup" &&
    to.name !== "MyPageReissue" &&
    to.name !== "MyPageResetPassword" &&
    to.name !== "SiteFaq" &&
    to.name !== "SiteAbout" &&
    to.name !== "ProductIndexHealing" &&
    to.name !== "ProductIndexInspiration" &&
    to.name !== "ProductIndexMaintenance" &&
    to.name !== "ProductIndex" &&
    to.name !== "ProductShow" &&
    to.name !== "BlogIndex" &&
    to.name !== "BlogShow" &&
    to.name !== "CartIndex" &&
    to.name !== "SiteSct" &&
    to.name !== "Error500" &&
    to.name !== "Diagnose0" &&
    to.name !== "Diagnose1" &&
    to.name !== "Diagnose2" &&
    to.name !== "Diagnose3" &&
    to.name !== "Diagnose4" &&
    to.name !== "Diagnose5" &&
    to.name !== "DiagnoseResult" &&
    !store.state.isLogin
  ) {
    next("/mypage/login");
    return;
  }
  next();
});

export default router;
