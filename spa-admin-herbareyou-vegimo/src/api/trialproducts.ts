import request from "@/utils/request";

export const indexProductApi = (search: any = {}): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}trialproducts`,
    method: "get",
    params: search,
  });

export const showProductApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}trialproducts/${id}`,
    method: "get",
  });

export const updateProductApi = (id: number, data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}trialproducts/${id}`,
    method: "put",
    data: data,
  });

export const storeProductApi = (data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}trialproducts`,
    method: "post",
    data: data,
  });

export const destroyProductApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}trialproducts/${id}`,
    method: "delete",
  });
