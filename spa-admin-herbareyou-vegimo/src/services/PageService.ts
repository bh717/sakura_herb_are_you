import { BaseService } from "@/services/BaseService";

export class PageService extends BaseService {
  constructor() {
    super();
  }

  get0Padding(num: number, count: number): string {
    return ("000000000000" + String(num)).slice(-1 * count);
  }

  cutText(num: number, omitText: string, text: string): string {
    if (text.length <= num) {
      return text;
    }
    let cutText = String(text).substr(0, num);
    if (text.length > num) {
      cutText += omitText;
    }
    return cutText;
  }

  toBottom() {
    const element = document.documentElement;
    const bottom = element.scrollHeight - element.clientHeight;
    window.scroll(0, bottom);
  }

  implode(separator: string = "", array: any[]): string {
    let result = "";
    for (let i = 0; i < array.length; i++) {
      result += array[i];
      if (i !== array.length - 1) {
        result += separator;
      }
    }
    return result;
  }

  pluck(key: string = "", array: any[]): any[] {
    let result: any[] = [];
    for (let i = 0; i < array.length; i++) {
      result.push(array[i][key]);
    }
    return result;
  }

  getQueryObjectForUrl(): any {
    const query = location.search.slice(1);
    return Object.fromEntries(query.split("&").map((s) => s.split("=")));
  }

  // 2022年1月10日
  dateFormmat1(date: string): string {
    const dateObj = new Date(date);
    return (
      dateObj.getFullYear() +
      "年" +
      (dateObj.getMonth() + 1) +
      "月" +
      dateObj.getDate() +
      "日"
    );
  }

  // 2022年1月10日(月)
  dateFormmat2(date: string): string {
    const dateObj = new Date(date);
    return (
      dateObj.getFullYear() +
      "年  " +
      (dateObj.getMonth() + 1) +
      "月  " +
      dateObj.getDate() +
      "日  " +
      "  (" +
      ["日", "月", "火", "水", "木", "金", "土"][dateObj.getDay()] +
      ")"
    );
  }

  // 2022-01-10
  dateFormmat3(date: string, add: number = 0): string {
    const dateObj = new Date(date);
    dateObj.setDate(dateObj.getDate() + add);
    return (
      dateObj.getFullYear() +
      "-" +
      this.get0Padding(dateObj.getMonth() + 1, 2) +
      "-" +
      this.get0Padding(dateObj.getDate(), 2)
    );
  }

  // 2022/01/10
  dateFormmat4(date: string, add: number = 0): string {
    const dateObj = new Date(date);
    dateObj.setDate(dateObj.getDate() + add);
    return (
      dateObj.getFullYear() +
      "/" +
      this.get0Padding(dateObj.getMonth() + 1, 2) +
      "/" +
      this.get0Padding(dateObj.getDate(), 2)
    );
  }

  // 2022/01/10
  dateFormmat5ByUnix(unixTime: number): string {
    const dateObj = new Date(unixTime * 1000);
    return (
      dateObj.getFullYear() +
      "-" +
      this.get0Padding(dateObj.getMonth() + 1, 2) +
      "-" +
      this.get0Padding(dateObj.getDate(), 2)
    );
  }

  // 2022-01-10
  tody(date: string, add: number = 0): string {
    const dateObj = new Date();
    dateObj.setDate(dateObj.getDate() + add);
    return (
      dateObj.getFullYear() +
      "-" +
      this.get0Padding(dateObj.getMonth() + 1, 2) +
      "-" +
      this.get0Padding(dateObj.getDate(), 2)
    );
  }
}
