import request from "@/utils/request";

export const indexProductCategoryApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-categories`,
    method: "get",
  });

export const showProductCategoryApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-categories/${id}`,
    method: "get",
  });

export const storeProductCategoryApi = (
  name: string,
  seriesName: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-categories`,
    method: "post",
    data: {
      name: name,
      series_name: seriesName,
    },
  });

export const updateProductCategoryApi = (
  id: number,
  name: string,
  seriesName: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-categories/${id}`,
    method: "put",
    data: {
      name: name,
      series_name: seriesName,
    },
  });

export const destroyProductCategoryApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}product-categories/${id}`,
    method: "delete",
  });
