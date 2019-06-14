import { Worker } from "../worker/worker.model";

export class Alarm {
  id?: number;
  dateStart: string;
  dateStop?: string;
  workerStart: Worker;
  workerStop?: Worker;
}
