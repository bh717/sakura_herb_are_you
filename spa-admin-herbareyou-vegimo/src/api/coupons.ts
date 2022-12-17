import request from "@/utils/request";

export const indexCouponApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}coupons`,
    method: "get",
  });

export const showCouponApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}coupons/${id}`,
    method: "get",
  });

export const storeCouponApi = (data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}coupons`,
    method: "post",
    data: data,
  });

export const updateCouponApi = (id: number, data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}coupons/${id}`,
    method: "put",
    data: data,
  });

export const destroyCouponApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}coupons/${id}`,
    method: "delete",
  });
