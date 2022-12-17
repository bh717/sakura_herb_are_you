import axios from "axios";
import { ApiUrls } from "@/consts/ApiUrls";
import { BaseService } from "@/services/BaseService";

export class ColormeMappingService extends BaseService {
  constructor() {
    super();
  }

  async indexApi(search: any = {}): Promise<any> {
    console.log(search);
    return await this.get(ApiUrls.colormeMapping(), search)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async updateApi(id: number, data: any): Promise<any> {
    return await this.put(ApiUrls.colormeMapping(id), data)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }
}
