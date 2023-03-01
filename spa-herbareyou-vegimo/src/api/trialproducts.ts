import request from "@/utils/request";

export const indexProductApi = (search: any = {}): Promise<any> =>
  request({
    url: `/trialproducts`,
    method: "get",
    params: search,
  });

export const showTrialProductApi = (id: number): Promise<any> =>
  request({
    url: `/trialproducts/${id}`,
    method: "get",
  });

export const indexCategoriesApi = (): Promise<any> =>
  request({
    url: `/trialproducts/categories`,
    method: "get",
  });

  export const indexKindApi = (id:Number): Promise<any> =>
  request({
    url: `/trialproducts/kind/${id}`,
    method: "get",
  });

  export const indexSubItem = (id:Number): Promise<any> =>
  request({
    url: `/trialproducts/subitem/${id}`,
    method: "get",
  });


  export const showSubProductApi = (id: number): Promise<any> =>
  request({
    url: `/products/${id}`,
    method: "get",
  });