import request from "@/utils/request";

export const indexOrderApi = (search: any = {}): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}orders`,
    method: "get",
    params: search,
  });

export const showOrderApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}orders/${id}`,
    method: "get",
  });

export const updateOrderStatusApi = (
  id: number,
  status: number
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}orders/${id}/updateStatus`,
    data: {
      status: status,
    },
    method: "put",
  });

  export const updateDeliveryLocationApi = (
  id: number,
  data: any[]
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}orders/${id}/updateDeliveryLocation`,
    data: data,
    method: "put",
  });
