import request from "@/utils/request";

export const indexFaqCategoryApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}faq-categories`,
    method: "get",
  });
