import request from "@/utils/request";

export const showDetailedTastesApi = (id: number): Promise<any> =>
  request({
    url: `/detailedtastes/tastes/${id}`,
    method: "get",
  });
