import * as moment from "moment";
import {Pipe, PipeTransform} from "@angular/core";

@Pipe({
  name: 'getDate',
  pure: true
})
export class GetDateFormatedPipe implements PipeTransform {
  transform(value: string, ...args: any[]): any {
    return args.includes('fullDate') ? this.getFullDate(value) : this.getDate(value);
  }
  getDate = (date: string) => moment(date).format("DD-MM-YYYY");
  getFullDate = (date: string) => moment(date).format("DD-MM-YYYY HH:mm");

}
