import axios from "axios";
import { ApiUrls } from "@/consts/ApiUrls";
import { BaseService } from "@/services/BaseService";

export class SaleService extends BaseService {
  constructor() {
    super();
  }

  async indexApi(search: any = {}): Promise<any> {
    console.log(search);
    return await this.get(ApiUrls.sales(), search)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async resettingResponsibleApi(
    saleId: number,
    companyId: number
  ): Promise<any> {
    return await this.put(ApiUrls.salesResettingResponsible(), {
      sale_id: saleId,
      company_id: companyId,
    })
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }
}
