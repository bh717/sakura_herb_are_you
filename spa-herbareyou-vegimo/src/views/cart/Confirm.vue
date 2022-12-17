<template>
  <div class="wrapper">
    <Header />
    <main class="main">
      <article>
        <section class="sec">
          <div class="sec-container" v-if="isPurchaseSuccess">
            <h2 class="sec-container-hd2">支払いが完了しました</h2>
            <p class="sec-container-hd2">ありがとうございました</p>
          </div>
          <div class="sec-container" v-if="isNotPurchaseSuccess">
            <h2 class="sec-container-hd2">支払いが失敗しました</h2>
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
import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
import ValidateError from "@/components/ValidateError.vue";
import { confirmApi } from "@/api/orders";
import { allDeleteProductPriceData } from "@/utils/cart";

export default defineComponent({
  name: "CartConfirm",
  watch: {},
  data() {
    return {
      isShow: false,
      message: "",
      validateErrors: {} as any,
      submitDisable: false,
      carts: [] as any[],
      couponCode: "",
      deliveryLocation: {} as any,
      selectedDeliveredAt: "",
      deliveredAtList: [] as string[],
      isPurchaseSuccess: false,
      isNotPurchaseSuccess: false,
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
    document.body.className = "";
    // カートデータを空にする
    allDeleteProductPriceData();
    this.confirm();
    this.isShow = true;
    this.$nextTick(function () {
      this.commonScriptService.execute();
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
    confirm: async function (event: any) {
      const queryData = this.pageService.getQueryObjectForUrl();
      if (!queryData.order_number || !queryData.trans_code) {
        this.isNotPurchaseSuccess = true;
        return;
      }
      const confirmResult = await confirmApi(
        queryData.order_number,
        queryData.trans_code,
        queryData.result
      );
      if (!confirmResult.success) {
        this.commonError(confirmResult);
        this.isNotPurchaseSuccess = true;
        return;
      }
      this.isPurchaseSuccess = true;
      setTimeout(() => {
        this.$router.push({
          name: "Home",
        });
      }, 1 * 1000);
      return;
    },
    selectDeliveredAt(selectedDeliveredAt: string): void {
      this.selectedDeliveredAt = selectedDeliveredAt;
    },
  },
});
</script>
<style scoped src="@/assets/css/purchase.css"></style>
