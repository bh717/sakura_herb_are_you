import request from "@/utils/request";

export const showDetailedSymptomsApi = (id: number): Promise<any> =>
  request({
    url: `/detailedsymptoms/symptoms/${id}`,
    method: "get",
  });
