import request from "@/utils/request";

export const showCartMineApi = (productPriceData: any): Promise<any> =>
  request({
    url: "/carts/mine",
    method: "post",
    data: productPriceData
  });

export const mine = (couponCode: string): Promise<any> =>
  request({
    url: "/mine",
    method: "post",
    data: {
      coupon_code: couponCode,
    },
  });
