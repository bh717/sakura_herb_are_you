import request from "@/utils/request";
import axios from "axios";

export const getPreSignedUrlApi = (
  filenName: string,
  filePath = ""
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}upload-files/getPreSignedUrl`,
    method: "post",
    params: {
      file_name: filenName,
      file_path: filePath,
    },
  });

export const confirmApi = (hash: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}upload-files/confirm`,
    method: "post",
    params: {
      hash: hash,
    },
  });

export const upload = (url: string, file: any): Promise<any> => {
  const headers = {
    "Content-Type": file.type,
  };
  return axios
    .put(url, file, { headers: headers })
    .then((response) => {
      return {
        success: true,
      };
    })
    .catch((error) => {
      console.log(error.status);
      return {
        success: false,
      };
    });
};
