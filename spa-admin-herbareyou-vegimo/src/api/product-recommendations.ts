import request from "@/utils/request";

export const indexProductRecommendationApi = (search: any = {}): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-recommendations`,
    method: "get",
    params: search,
  });

export const createProductRecommendationApi = (
  producIds: number[],
  kind: number
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-recommendations`,
    method: "post",
    data: {
      product_ids: producIds,
      kind: kind,
    },
  });
