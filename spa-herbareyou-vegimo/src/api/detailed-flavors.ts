import request from "@/utils/request";

export const showDetailedFlavorsApi = (id: number): Promise<any> =>
  request({
    url: `/detailedflavors/flavors/${id}`,
    method: "get",
  });
