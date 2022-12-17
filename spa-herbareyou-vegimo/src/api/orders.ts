import request from "@/utils/request";

export const storeOrderApi = (
  productPrice: any,
  couponCode: null | string,
  // deliveredAt: null | string
): Promise<any> =>
  request({
    url: "/orders",
    method: "post",
    data: {
      delivered_at: null,
      product_prices: productPrice,
      coupon_code: couponCode,
    },
  });

export const getDeliveredListApi = (): Promise<any> =>
  request({
    url: "/orders/getDeliveredAtList",
    method: "get",
  });

export const indexOrderDetailsApi = (): Promise<any> =>
  request({
    url: "/order-details",
    method: "get",
  });

export const confirmApi = (
  orderNo: string,
  transCode: string,
  result: string
): Promise<any> =>
  request({
    url: "/order/confirm",
    method: "post",
    data: {
      order_no: orderNo,
      trans_code: transCode,
      result: result,
    },
  });
