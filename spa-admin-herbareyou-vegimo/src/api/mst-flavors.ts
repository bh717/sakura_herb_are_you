import request from "@/utils/request";

export const indexFlavorApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}flavors`,
    method: "get",
  });

export const showFlavorApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}flavors/${id}`,
    method: "get",
  });

export const storeFlavorApi = (name: string, categoryNo: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}flavors`,
    method: "post",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const updateFlavorApi = (
  id: number,
  name: string,
  categoryNo: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}flavors/${id}`,
    method: "put",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const destroyFlavorApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}flavors/${id}`,
    method: "delete",
  });
