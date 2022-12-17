import request from "@/utils/request";

export const indexFaqCategoryApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faq-categories`,
    method: "get",
  });

export const showFaqCategoryApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faq-categories/${id}`,
    method: "get",
  });

export const storeFaqCategoryApi = (name: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faq-categories`,
    method: "post",
    data: {
      name: name,
    },
  });

export const updateFaqCategoryApi = (id: number, name: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faq-categories/${id}`,
    method: "put",
    data: {
      name: name,
    },
  });

export const destroyFaqCategoryApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faq-categories/${id}`,
    method: "delete",
  });
