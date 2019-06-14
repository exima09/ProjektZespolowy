import {Worker} from "../worker/worker.model";
import {Prisoner} from "../prisoner/prisoner.model";
import {JailJob} from "../jail-job/jailJob.model";

export class JailJobSchedule {
  id?: number;
  prisoner: Prisoner;
  worker: Worker;
  jailJob: JailJob;
  dateFrom: string;
  dateTo: string;
  rate?: number;
}
