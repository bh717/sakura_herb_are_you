import request from "@/utils/request";

export const indexFaqApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faqs`,
    method: "get",
  });

export const showFaqApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faqs/${id}`,
    method: "get",
  });

export const storeFaqApi = (data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faqs`,
    method: "post",
    data: data,
  });

export const updateFaqApi = (id: number, data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faqs/${id}`,
    method: "put",
    data: data,
  });

export const destroyFaqApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faqs/${id}`,
    method: "delete",
  });
