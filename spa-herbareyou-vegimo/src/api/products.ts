import request from "@/utils/request";

export const indexProductApi = (search: any = {}): Promise<any> =>
  request({
    url: `/products`,
    method: "get",
    params: search,
  });

export const showProductApi = (id: number): Promise<any> =>
  request({
    url: `/products/${id}`,
    method: "get",
  });

export const indexCategoriesApi = (): Promise<any> =>
  request({
    url: `/products/categories`,
    method: "get",
  });
