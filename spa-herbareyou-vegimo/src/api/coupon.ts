import request from "@/utils/request";

export const effectivenessCouponApi = (
  productPrice: any,
  couponCode: string,
): Promise<any> =>
  request({
    url: "/coupons/effectiveness",
    method: "post",
    data: {
      product_prices: productPrice,
      coupon_code: couponCode,
    },
  });
