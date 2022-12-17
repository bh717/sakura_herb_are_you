import request from "@/utils/request";

export const showDetailedSymptomsProductApi = (name: string, id: string): Promise<any> =>
  request({
    url: `/detailedsymptomsproduct/symptoms/${name}/${id}`,
    method: "get",
  });
