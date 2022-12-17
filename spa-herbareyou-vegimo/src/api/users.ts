import request from "@/utils/request";

export const updateUserDeliveryLocationApi = (search: any = {}): Promise<any> =>
  request({
    url: `/user-delivery-locations`,
    method: "put",
    params: search,
  });

export const showUserDeliveryLocationApi = (): Promise<any> =>
  request({
    url: `/user-delivery-locations`,
    method: "get",
  });
