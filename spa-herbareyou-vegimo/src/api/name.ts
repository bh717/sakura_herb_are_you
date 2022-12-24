import request from "@/utils/request";

export const getName = (email: string): Promise<any> =>
    request({
        url: `/loginName/getNameByEmail/${email}`,
        method: "get"
    });