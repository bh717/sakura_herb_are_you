import request from "@/utils/request";

export const showCartApi = (): Promise<any> =>
  request({
    url: "/carts",
    method: "get",
  });

export const addCouponApi = (couponCode: string): Promise<any> =>
  request({
    url: "/inquiries",
    method: "post",
    data: {
      coupon_code: couponCode,
    },
  });

export const storeCartDetailApi = (
  productPriceId: number,
  num: number
): Promise<any> =>
  request({
    url: "/cart-details",
    method: "post",
    data: {
      product_price_id: productPriceId,
      num: num,
    },
  });

export const upadteCartDetailNumApi = (
  cartDetailId: number,
  num: number
): Promise<any> =>
  request({
    url: `/cart-details/${cartDetailId}/num`,
    method: "put",
    data: {
      num: num,
    },
  });

export const upadteCartDetailProductPriceApi = (
  cartDetailId: number,
  productPriceId: number
): Promise<any> =>
  request({
    url: `/product-price/${cartDetailId}/product-price`,
    method: "put",
    data: {
      product_price_id: productPriceId,
    },
  });

// export const destroyCartDetailApi = (id: number): Promise<any> =>
//   request({
//     url: `/cart-details/${id}`,
//     method: "delete",
//   });
